<?php

// This is generated automatically by Puppet. Edit at your own risk.

define( 'DB_NAME',     'wordpress' );
define( 'DB_USER',     'wordpress' );
define( 'DB_PASSWORD', 'vagrantpassword' );
define( 'DB_HOST',     'localhost' );

$table_prefix = 'wp_';

defined( 'ABSPATH' ) or define( 'ABSPATH', '/vagrant/wp/' );
defined( 'WP_CONTENT_DIR' ) or define( 'WP_CONTENT_DIR', '/vagrant/content' );


if ( ! defined( 'WP_INSTALLING' ) || ! WP_INSTALLING ) {
	define( 'MULTISITE', true );
	define( 'SUBDOMAIN_INSTALL', true );
	define( 'DOMAIN_CURRENT_SITE', 'thechive-preview.x-team.vvv' );
	define( 'PATH_CURRENT_SITE', '/' );
	define( 'SITE_ID_CURRENT_SITE', 1 );
	define( 'BLOG_ID_CURRENT_SITE', 1 );
}
if ( empty( $_SERVER['HTTP_HOST'] ) ) {
	$_SERVER['HTTP_HOST'] = 'thechive-preview.x-team.vvv';
}

