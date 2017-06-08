<?php
// ===================================================
// Editing of this file is discouraged. Create a local-config.php to define custom constants.
// ===================================================

// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config-db.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config-db.php' );
}

if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	defined('WP_LOCAL_DEV') or define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );
} elseif ( ! defined('WP_LOCAL_DEV') ) {
	define( 'WP_LOCAL_DEV', false );
	define( 'DB_NAME', '%%DB_NAME%%' );
	define( 'DB_USER', '%%DB_USER%%' );
	define( 'DB_PASSWORD', '%%DB_PASSWORD%%' );
	define( 'DB_HOST', '%%DB_HOST%%' ); // Probably 'localhost'
}

// =======================================
// Check that we actually have a DB config
// =======================================
if ( ! defined( 'DB_HOST' ) || strpos( DB_HOST, '%%' ) !== false ) {
	header('X-WP-Error: dbconf', true, 500);
	echo '<h1>Database configuration is incomplete.</h1>';
	echo "<p>If you're developing locally, ensure you have a local-config.php.
	If this is in production, deployment is broken.</p>";
	die(1);
}

// =======================
// Load Chassis extensions
// =======================
if ( file_exists( dirname( __FILE__ ) . '/local-config-extensions.php' ) ) {
	include( dirname( __FILE__ ) . '/local-config-extensions.php' );
}

// ==================
// Set up WP location
// ==================
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
}

// ======================================
// Fake HTTP Host (for CLI compatibility)
// ======================================
if ( ! isset( $_SERVER['HTTP_HOST'] ) ) {
	if ( defined( 'DOMAIN_CURRENT_SITE' ) ) {
		$_SERVER['HTTP_HOST'] = DOMAIN_CURRENT_SITE;
	} else {
		$_SERVER['HTTP_HOST'] = 'vagrant.local';
	}
}

// ========================
// Custom Content Directory
// ========================
defined('WP_CONTENT_DIR') or define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
defined('WP_CONTENT_URL') or define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// =======================
// Use built-in themes too
// =======================
if ( empty( $GLOBALS['wp_theme_directories'] ) ) {
	$GLOBALS['wp_theme_directories'] = array();
}
if ( file_exists( WP_CONTENT_DIR . '/themes' ) ) {
	$GLOBALS['wp_theme_directories'][] = WP_CONTENT_DIR . '/themes';
}
$GLOBALS['wp_theme_directories'][] = ABSPATH . 'wp-content/themes';
$GLOBALS['wp_theme_directories'][] = ABSPATH . 'wp-content/themes';

// =============================
// Configuration for the Content
// =============================
if ( file_exists( WP_CONTENT_DIR . '/config.php' ) ) {
	include( WP_CONTENT_DIR . '/config.php' );
}

// =====================
// URL hacks for Vagrant
// =====================
if ( WP_LOCAL_DEV && ! defined('WP_SITEURL') && ! defined( 'WP_INSTALLING' ) ) {
	define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wp');

	if ( ! defined( 'WP_HOME' ) ) {
		define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
	}
}

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         'TipI+hxW}<ZCj*yLF<m{qJ1-!z;V8IVt_k9o%B^-}BpnaF2vs{dw*=9Mvf&%C_@^');
define('SECURE_AUTH_KEY',  '*hV,J-/~#00xGe#:a#&1f]~eB&f<P/1Z#|%--XT75;Tb;3PyqK);d%+eSjl#0mj ');
define('LOGGED_IN_KEY',    'D>Yx$|-A+t>4d7okot~{8o1.YF&Q.ryO_m_|;=ov6Ym`M-^64x3L*.v%XJvYXaa6');
define('NONCE_KEY',        ']/d2N@DZj.TsE-=|o5JF-jK6PO!<$k*25:slt#^.Aa_e+M9{FxE-H1(&Xp~*+xgl');
define('AUTH_SALT',        '~N)0 rUCn.1RlVEFxESYM1/IUg]TSY^QN+aJz_sW+ ]}nq<@O!-=6@+P%qAcM!cD');
define('SECURE_AUTH_SALT', '.`?kD,PP#,J..SQz* {voAR_u#AFnb}jOD`3~P8Y2:K,1gY!J=R!`<jse^uR~to8');
define('LOGGED_IN_SALT',   'zwHS&>vp#y{8&sFTvrmuU,9YEiV` Gna+kP{;ATS||Lfja6n;H@COfE*yivpb0;a');
define('NONCE_SALT',       '*a8n%uNUzq>!0i&QxFLP8?h $]fQBfWEeKFHycf^}kUpmBnTtMA v9*kc{^%M>#k');

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
if ( empty( $table_prefix ) ) {
	$table_prefix  = 'wp_';
}

// =====================================
// Errors
// Show/hide errors for local/production
// =====================================
if ( WP_LOCAL_DEV ) {
	defined( 'WP_DEBUG' ) or define( 'WP_DEBUG', true );
}
// Only override if not already set
elseif ( ! defined( 'WP_DEBUG_DISPLAY' ) ) {
	ini_set( 'display_errors', 0 );
	define( 'WP_DEBUG_DISPLAY', false );
}

// ===================
// Bootstrap WordPress
// ===================
if ( ! file_exists( ABSPATH . 'wp-settings.php' ) ) {
	header('X-WP-Error: wpmissing', true, 500);
	echo '<h1>WordPress is missing.</h1>';
	die(1);
}
require_once( ABSPATH . 'wp-settings.php' );
