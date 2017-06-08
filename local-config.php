<?php
// Note: Database constants are set in the automatically-generated
// local-config-db.php. Change these via your config.local.yaml instead.

// Loopback connections can suck, disable if you don't need cron
# define( 'DISABLE_WP_CRON', true );

// You'll probably want Automatic Updates disabled during development
define( 'AUTOMATIC_UPDATER_DISABLED', true );


# define('COOKIE_DOMAIN', false);
define('WP_CACHE', true);
define( 'WP_DEBUG', true );
define( 'SAVEQUERIES', true );

if ( ! defined( 'JETPACK_DEV_DEBUG' ) ) {
	define( 'JETPACK_DEV_DEBUG', true );
}

// Put Keyring into headless mode
define( 'KEYRING__HEADLESS_MODE', true );

define( 'MULTISITE', true );
#define( 'SUNRISE', true );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

if ( ! defined( 'DOMAIN_CURRENT_SITE' ) ) {
	define( 'DOMAIN_CURRENT_SITE', $_SERVER['HTTP_HOST'] );
}

// You'll probably want debug logging during development
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'SCRIPT_DEBUG', true );
define( 'SUBDOMAIN_INSTALL', true );


if ( WP_DEBUG ) {
	error_reporting( E_ALL & ~E_STRICT );
}
