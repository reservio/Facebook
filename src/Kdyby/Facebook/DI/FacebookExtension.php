<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

namespace Kdyby\Facebook\DI;

use Kdyby\Facebook\Api\CurlClient;
use Nette;
use Nette\Utils\Validators;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class FacebookExtension extends Nette\DI\CompilerExtension
{
	public function getConfigSchema(): Nette\Schema\Schema
	{
		return Nette\Schema\Expect::structure([
			'appId' => Nette\Schema\Expect::string(),
			'appSecret' => Nette\Schema\Expect::string(),
			'verifyApiCalls' => Nette\Schema\Expect::bool()->default(TRUE),
			'fileUploadSupport' => Nette\Schema\Expect::bool()->default(FALSE),
			'trustForwarded' => Nette\Schema\Expect::bool()->default(FALSE),
			'clearAllWithLogout' => Nette\Schema\Expect::bool()->default(TRUE),
			'domains' => Nette\Schema\Expect::array()->default([]),
			'permissions' => Nette\Schema\Expect::array()->default([]),
			'canvasBaseUrl' => Nette\Schema\Expect::string(NULL)->nullable(),
			'graphVersion' => Nette\Schema\Expect::string()->default(''),
			'curlOptions' => Nette\Schema\Expect::array()->default(CurlClient::$defaultCurlOptions),
			'debugger' => Nette\Schema\Expect::string()->default('%debugMode%'),
		]);
	}

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$config = (array) $this->getConfig();
		Validators::assert($config['appId'], 'string', 'Application ID');
		Validators::assert($config['appSecret'], 'string:32', 'Application secret');
		Validators::assert($config['fileUploadSupport'], 'bool', 'file upload support');
		Validators::assert($config['trustForwarded'], 'bool', 'trust forwarded');
		Validators::assert($config['clearAllWithLogout'], 'bool', 'clear the facebook session when user changes');
		Validators::assert($config['domains'], 'array', 'api domains');
		Validators::assert($config['permissions'], 'list', 'permissions scope');
		Validators::assert($config['canvasBaseUrl'], 'null|url', 'base url for canvas application');

		$configurator = $builder->addDefinition($this->prefix('config'))
			->setClass('Kdyby\Facebook\Configuration')
			->setArguments([$config['appId'], $config['appSecret']])
			->addSetup('$verifyApiCalls', [$config['verifyApiCalls']])
			->addSetup('$fileUploadSupport', [$config['fileUploadSupport']])
			->addSetup('$trustForwarded', [$config['trustForwarded']])
			->addSetup('$permissions', [$config['permissions']])
			->addSetup('$canvasBaseUrl', [$config['canvasBaseUrl']])
			->addSetup('$graphVersion', [$config['graphVersion']])
			->addTag(Nette\DI\Extensions\InjectExtension::TAG_INJECT, FALSE);

		if ($config['domains']) {
			$configurator->addSetup('$service->domains = ? + $service->domains', [$config['domains']]);
		}

		$builder->addDefinition($this->prefix('session'))
			->setClass('Kdyby\Facebook\SessionStorage')
            ->setArgument('config', $this->prefix('@config'))
			->addTag(Nette\DI\Extensions\InjectExtension::TAG_INJECT, FALSE);

		foreach ($config['curlOptions'] as $option => $value) {
			if (defined($option)) {
				unset($config['curlOptions'][$option]);
				$config['curlOptions'][constant($option)] = $value;
			}
		}

		$apiClient = $builder->addDefinition($this->prefix('apiClient'))
			->setFactory('Kdyby\Facebook\Api\CurlClient')
			->setClass('Kdyby\Facebook\ApiClient')
			->addSetup('$service->curlOptions = ?;', [$config['curlOptions']])
			->addTag(Nette\DI\Extensions\InjectExtension::TAG_INJECT, FALSE);

		if ($config['debugger']) {
			$builder->addDefinition($this->prefix('panel'))
				->setClass('Kdyby\Facebook\Diagnostics\Panel')
				->addTag(Nette\DI\Extensions\InjectExtension::TAG_INJECT);

			$apiClient->addSetup($this->prefix('@panel') . '::register', ['@self']);
		}

		$builder->addDefinition($this->prefix('client'))
			->setClass('Kdyby\Facebook\Facebook')
            ->setArgument('config', $this->prefix('@config'))
            ->setArgument('session', $this->prefix('@session'))
            ->setArgument('client', $this->prefix('@apiClient'))
            ->addTag(Nette\DI\Extensions\InjectExtension::TAG_INJECT, FALSE);

		if ($config['clearAllWithLogout']) {
			$builder->getDefinition('user')
				->addSetup('$sl = ?; ?->onLoggedOut[] = function () use ($sl) { $sl->getService(?)->clearAll(); }', [
					'@container', '@self', $this->prefix('session')
				]);
		}
	}



	/**
	 * @param \Nette\Configurator $configurator
	 */
	public static function register(Nette\Configurator $configurator)
	{
		$configurator->onCompile[] = function ($config, Nette\DI\Compiler $compiler) {
			$compiler->addExtension('facebook', new FacebookExtension());
		};
	}

}
