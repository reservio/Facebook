<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

namespace Kdyby\Facebook;

use Nette;
use Nette\Http\Url;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Configuration
{

	use Nette\SmartObject;

	/** @deprecated */
	const USER_EMAIL = 'email';
	/** @deprecated */
	const USER_PUBLISH_ACTIONS = "publish_actions";
	/** @deprecated */
	const USER_ABOUT_ME = "user_about_me";
	/** @deprecated */
	const USER_ACTIVITIES = "user_activities";
	/** @deprecated */
	const USER_BIRTHDAY = "user_birthday";
	/** @deprecated */
	const USER_EDUCATION_HISTORY = "user_education_history";
	/** @deprecated */
	const USER_EVENTS = "user_events";
	/** @deprecated */
	const USER_GAMES_ACTIVITY = "user_games_activity";
	/** @deprecated */
	const USER_GROUPS = "user_groups";
	/** @deprecated */
	const USER_HOMETOWN = "user_hometown";
	/** @deprecated */
	const USER_INTERESTS = "user_interests";
	/** @deprecated */
	const USER_LIKES = "user_likes";
	/** @deprecated */
	const USER_LOCATION = "user_location";
	/** @deprecated */
	const USER_NOTES = "user_notes";
	/** @deprecated */
	const USER_PHOTOS = "user_photos";
	/** @deprecated */
	const USER_QUESTIONS = "user_questions";
	/** @deprecated */
	const USER_RELATIONSHIP_DETAILS = "user_relationship_details";
	/** @deprecated */
	const USER_RELATIONSHIPS = "user_relationships";
	/** @deprecated */
	const USER_RELIGION_POLITICS = "user_religion_politics";
	/** @deprecated */
	const USER_STATUS = "user_status";
	/** @deprecated */
	const USER_SUBSCRIPTIONS = "user_subscriptions";
	/** @deprecated */
	const USER_VIDEOS = "user_videos";
	/** @deprecated */
	const USER_WEBSITE = "user_website";
	/** @deprecated */
	const USER_WORK_HISTORY = "user_work_history";

	/** @deprecated in v2.0 */
	const FRIENDS_ABOUT_ME = "friends_about_me";
	/** @deprecated in v2.0 */
	const FRIENDS_ACTIVITIES = "friends_activities";
	/** @deprecated in v2.0 */
	const FRIENDS_BIRTHDAY = "friends_birthday";
	/** @deprecated in v2.0 */
	const FRIENDS_EDUCATION_HISTORY = "friends_education_history";
	/** @deprecated in v2.0 */
	const FRIENDS_EVENTS = "friends_events";
	/** @deprecated in v2.0 */
	const FRIENDS_GAMES_ACTIVITY = "friends_games_activity";
	/** @deprecated in v2.0 */
	const FRIENDS_GROUPS = "friends_groups";
	/** @deprecated in v2.0 */
	const FRIENDS_HOMETOWN = "friends_hometown";
	/** @deprecated in v2.0 */
	const FRIENDS_INTERESTS = "friends_interests";
	/** @deprecated in v2.0 */
	const FRIENDS_LIKES = "friends_likes";
	/** @deprecated in v2.0 */
	const FRIENDS_LOCATION = "friends_location";
	/** @deprecated in v2.0 */
	const FRIENDS_NOTES = "friends_notes";
	/** @deprecated in v2.0 */
	const FRIENDS_PHOTOS = "friends_photos";
	/** @deprecated in v2.0 */
	const FRIENDS_QUESTIONS = "friends_questions";
	/** @deprecated in v2.0 */
	const FRIENDS_RELATIONSHIP_DETAILS = "friends_relationship_details";
	/** @deprecated in v2.0 */
	const FRIENDS_RELATIONSHIPS = "friends_relationships";
	/** @deprecated in v2.0 */
	const FRIENDS_RELIGION_POLITICS = "friends_religion_politics";
	/** @deprecated in v2.0 */
	const FRIENDS_STATUS = "friends_status";
	/** @deprecated in v2.0 */
	const FRIENDS_SUBSCRIPTIONS = "friends_subscriptions";
	/** @deprecated in v2.0 */
	const FRIENDS_VIDEOS = "friends_videos";
	/** @deprecated in v2.0 */
	const FRIENDS_WEBSITE = "friends_website";
	/** @deprecated in v2.0 */
	const FRIENDS_WORK_HISTORY = "friends_work_history";

	/** @deprecated */
	const EXTENDED_ADS_MANAGEMENT = "ads_management";
	/** @deprecated */
	const EXTENDED_CREATE_EVENT = "create_event";
	/** @deprecated */
	const EXTENDED_CREATE_NOTE = "create_note";
	/** @deprecated */
	const EXTENDED_EXPORT_STREAM = "export_stream";
	/** @deprecated */
	const EXTENDED_FRIENDS_ONLINE_PRESENCE = "friends_online_presence";
	/** @deprecated */
	const EXTENDED_MANAGE_FRIENDLISTS = "manage_friendlists";
	/** @deprecated */
	const EXTENDED_MANAGE_NOTIFICATIONS = "manage_notifications";
	/** @deprecated */
	const EXTENDED_MANAGE_PAGES = "manage_pages";
	/** @deprecated */
	const EXTENDED_OFFLINE_ACCESS = "offline_access";
	/** @deprecated */
	const EXTENDED_PHOTO_UPLOAD = "photo_upload";
	/** @deprecated */
	const EXTENDED_PUBLISH_CHECKINS = "publish_checkins";
	/** @deprecated */
	const EXTENDED_PUBLISH_STREAM = "publish_stream";
	/** @deprecated */
	const EXTENDED_READ_FRIENDLISTS = "read_friendlists";
	/** @deprecated */
	const EXTENDED_READ_INSIGHTS = "read_insights";
	/** @deprecated */
	const EXTENDED_READ_MAILBOX = "read_mailbox";
	/** @deprecated */
	const EXTENDED_READ_PAGE_MAILBOXES = "read_page_mailboxes";
	/** @deprecated */
	const EXTENDED_READ_REQUESTS = "read_requests";
	/** @deprecated */
	const EXTENDED_READ_STREAM = "read_stream";
	/** @deprecated */
	const EXTENDED_RSVP_EVENT = "rsvp_event";
	/** @deprecated */
	const EXTENDED_SHARE_ITEM = "share_item";
	/** @deprecated */
	const EXTENDED_SMS = "sms";
	/** @deprecated */
	const EXTENDED_STATUS_UPDATE = "status_update";
	/** @deprecated */
	const EXTENDED_USER_ONLINE_PRESENCE = "user_online_presence";
	/** @deprecated */
	const EXTENDED_VIDEO_UPLOAD = "video_upload";
	/** @deprecated */
	const EXTENDED_XMPP_LOGIN = "xmpp_login";

	/**
	 * Signed Request Algorithm.
	 */
	const SIGNED_REQUEST_ALGORITHM = 'HMAC-SHA256';

	/**
	 * The Application ID.
	 * @var string
	 */
	public $appId;

	/**
	 * The Application App Secret.
	 * @var string
	 */
	public $appSecret;

	/**
	 * Verify API calls by adding appsecret_proof to all calls
	 * @var string
	 */
	public $verifyApiCalls;

	/**
	 * Indicates if the CURL based @ syntax for file uploads is enabled.
	 * @var boolean
	 */
	public $fileUploadSupport = FALSE;

	/**
	 * Indicates if we trust HTTP_X_FORWARDED_* headers.
	 * @var boolean
	 */
	public $trustForwarded = FALSE;

	/**
	 * The default scope for login dialog.
	 * @see https://developers.facebook.com/docs/facebook-login/permissions/v2.1
	 * @var array
	 */
	public $permissions;

	/**
	 * The base url of canvas application.
	 * @var string
	 */
	public $canvasBaseUrl;

	/**
	 * Empty means v1.0 if app was created before  April 30th 2014, otherwise it defaults to v2.0.
	 * @see https://developers.facebook.com/docs/apps/changelog
	 *
	 * @var string
	 */
	public $graphVersion = '';

	/**
	 * Maps aliases to Facebook domains.
	 * @var array
	 */
	public $domains = [
		'api' => 'https://api.facebook.com/',
		'api_video' => 'https://api-video.facebook.com/',
		'api_read' => 'https://api-read.facebook.com/',
		'graph' => 'https://graph.facebook.com/',
		'graph_video' => 'https://graph-video.facebook.com/',
		'www' => 'https://www.facebook.com/',
	];

	/**
	 * List of query parameters that get automatically dropped when rebuilding the current URL.
	 * @var array
	 */
	public $dropQueryParams = [
		'code',
		'state',
		'signed_request',
	];

	/**
	 * @var array
	 */
	public $readOnlyCalls = [
		'admin.getallocation' => 1,
		'admin.getappproperties' => 1,
		'admin.getbannedusers' => 1,
		'admin.getlivestreamvialink' => 1,
		'admin.getmetrics' => 1,
		'admin.getrestrictioninfo' => 1,
		'application.getpublicinfo' => 1,
		'auth.getapppublickey' => 1,
		'auth.getsession' => 1,
		'auth.getsignedpublicsessiondata' => 1,
		'comments.get' => 1,
		'connect.getunconnectedfriendscount' => 1,
		'dashboard.getactivity' => 1,
		'dashboard.getcount' => 1,
		'dashboard.getglobalnews' => 1,
		'dashboard.getnews' => 1,
		'dashboard.multigetcount' => 1,
		'dashboard.multigetnews' => 1,
		'data.getcookies' => 1,
		'events.get' => 1,
		'events.getmembers' => 1,
		'fbml.getcustomtags' => 1,
		'feed.getappfriendstories' => 1,
		'feed.getregisteredtemplatebundlebyid' => 1,
		'feed.getregisteredtemplatebundles' => 1,
		'fql.multiquery' => 1,
		'fql.query' => 1,
		'friends.arefriends' => 1,
		'friends.get' => 1,
		'friends.getappusers' => 1,
		'friends.getlists' => 1,
		'friends.getmutualfriends' => 1,
		'gifts.get' => 1,
		'groups.get' => 1,
		'groups.getmembers' => 1,
		'intl.gettranslations' => 1,
		'links.get' => 1,
		'notes.get' => 1,
		'notifications.get' => 1,
		'pages.getinfo' => 1,
		'pages.isadmin' => 1,
		'pages.isappadded' => 1,
		'pages.isfan' => 1,
		'permissions.checkavailableapiaccess' => 1,
		'permissions.checkgrantedapiaccess' => 1,
		'photos.get' => 1,
		'photos.getalbums' => 1,
		'photos.gettags' => 1,
		'profile.getinfo' => 1,
		'profile.getinfooptions' => 1,
		'stream.get' => 1,
		'stream.getcomments' => 1,
		'stream.getfilters' => 1,
		'users.getinfo' => 1,
		'users.getloggedinuser' => 1,
		'users.getstandardinfo' => 1,
		'users.hasapppermission' => 1,
		'users.isappuser' => 1,
		'users.isverified' => 1,
		'video.getuploadlimits' => 1
	];



	/**
	 * Configuration of Facebook application.
	 *
	 * @param string $appId the application ID
	 * @param string $secret the application secret
	 * @param bool $fileUpload (optional) boolean indicating if file uploads are enabled
	 * @param bool $trustForwarded
	 */
	public function __construct($appId, $secret, $fileUpload = FALSE, $trustForwarded = FALSE)
	{
		$this->appId = $appId;
		$this->appSecret = $secret;
		$this->fileUploadSupport = $fileUpload;
		$this->trustForwarded = $trustForwarded;
	}



	/**
	 * Constructs and returns the name of the cookie that
	 * potentially houses the signed request for the app user.
	 * The cookie is not set by the BaseFacebook class, but
	 * it may be set by the JavaScript SDK.
	 *
	 * @return string the name of the cookie that would house the signed request value.
	 */
	public function getSignedRequestCookieName()
	{
		return 'fbsr_' . $this->appId;
	}



	/**
	 * Constructs and returns the name of the coookie that potentially contain
	 * metadata. The cookie is not set by the BaseFacebook class, but it may be
	 * set by the JavaScript SDK.
	 *
	 * @return string the name of the cookie that would house metadata.
	 */
	public function getMetadataCookieName()
	{
		return 'fbm_' . $this->appId;
	}



	/**
	 * Returns the access token that should be used for logged out
	 * users when no authorization code is available.
	 *
	 * @return string The application access token, useful for gathering public information about users and applications.
	 */
	public function getApplicationAccessToken()
	{
		return $this->appId . '|' . $this->appSecret;
	}



	/**
	 * Build the URL for given domain alias, path and parameters.
	 *
	 * @param string $name The name of the domain
	 * @param string $path Optional path (without a leading slash)
	 * @param array $params Optional query parameters
	 *
	 * @return Url The URL for the given parameters
	 */
    public function createUrl($name, $path = NULL, $params = [])
    {
        if (preg_match('~^https?://[^.]+\\.facebook\\.com/~', trim($path))) {
            $url = new Url($path);

        } else {
            $url = new Url($this->domains[$name]);

            if ($this->graphVersion) {
                $url->path .= $this->graphVersion . '/';
            }

            $url->path .= ltrim($path, '/');
        }

        $url->appendQuery(array_map(function ($param) {
            return $param instanceof Url ? (string)$param : $param;
        }, $params));

        return $url;
    }



	/**
	 * Build the URL for api given parameters.
	 *
	 * @param string $method the method name.
	 * @return Url The URL for the given parameters
	 */
	public function getApiUrl($method)
	{
		$name = 'api';
		if (isset($this->readOnlyCalls[strtolower($method)])) {
			$name = 'api_read';

		} else if (strtolower($method) === 'video.upload') {
			$name = 'api_video';
		}

		return $this->createUrl($name, 'restserver.php');
	}



	/**
	 * Generate a proof of App Secret
	 * This is required for all API calls originating from a server
	 * It is a sha256 hash of the access_token made using the app secret
	 *
	 * @param string $accessToken The access_token to be hashed (required)
	 *
	 * @return string The sha256 hash of the access_token
	 */
	public function getAppSecretProof($accessToken)
	{
		return hash_hmac('sha256', $accessToken, $this->appSecret);
	}

}
