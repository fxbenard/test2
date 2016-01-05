<?php
/**
 * Plugin Name:      EDD Test2
 * Plugin URI:      http://fxbenard.com/traductions/test2
 * Description:     EDD Test2
 * Version: 1.2.2
 * Author:          FX Bénard
 * Author URI:      https://fxbenard.com
 * Text Domain:     test2
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package         Test2
 * @author          FX Bénard <fx@fxbenard.com>
 * @copyright       Copyright (c) 2015 FX Bénard
 * @license         http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */

defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

// Test2 defines
define( 'TEST_2_VERSION', '1.2.2' );
define( 'TEST_2_STORE_URL', 'https://fxbenard.com' ); // Store URL for API call
define( 'TEST_2_ITEM_NAME', 'Test2' ); // Item Name for API call
define( 'TEST_2_FILE', __FILE__ );
define( 'TEST_2_URL', plugin_dir_url( TEST_2_FILE ) );
define( 'TEST_2_PATH', realpath( plugin_dir_path( TEST_2_FILE ) ) . '/' );
define( 'TEST_2_INC_PATH', realpath( TEST_2_PATH . 'inc' ) . '/' );
define( 'TEST_2_CLASSES_PATH', realpath( TEST_2_INC_PATH . 'classes' ) . '/' );
define( 'TEST_2_ADMIN_PATH', realpath( TEST_2_INC_PATH . 'admin' ) . '/' );
define( 'TEST_2_ADMIN_UI_PATH', realpath( TEST_2_ADMIN_PATH . 'ui' ) . '/' );
define( 'TEST_2_API_PATH', realpath( TEST_2_INC_PATH . 'api' ) . '/' );
define( 'TEST_2_FUNCTIONS_PATH', realpath( TEST_2_INC_PATH . 'functions' ) . '/' );
define( 'TEST_2_ASSETS_URL',  TEST_2_URL . 'assets/' );
define( 'TEST_2_ASSETS_JS_URL', TEST_2_ASSETS_URL . 'js/' );


/**
 * Tell WP what to do when plugin is loaded
 *
 * @since 1.2
 */
add_action( 'plugins_loaded', 'test_2_init' );
function test_2_init() {

	// Load translations
	load_plugin_textdomain( 'test2', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	if ( is_admin() ) {

		if ( ! class_exists( 'TEST_2_Plugin_Updater' ) ) {
				require ( TEST_2_CLASSES_PATH . 'TEST_2_Plugin_Updater.php' );
		}

		require ( TEST_2_ADMIN_PATH . 'options.php' );
		require ( TEST_2_ADMIN_PATH . 'enqueue.php' );
		require ( TEST_2_ADMIN_UI_PATH . 'actions.php' );
		require ( TEST_2_ADMIN_UI_PATH . 'notices.php' );
		require ( TEST_2_API_PATH . 'edd-software-licensing.php' );
		require ( TEST_2_FUNCTIONS_PATH . 'license.php' );

	}

}

/**
 * Setup the updater
 *
 * @since 1.0
 */
function test_2_plugin_updater() {

		$license_key = trim( get_option( 'test_2_license_key' ) );

		// setup the updater
		$edd_updater = new TEST_2_Plugin_Updater( TEST_2_STORE_URL, __FILE__, array(
			'version' 	=> TEST_2_VERSION,
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => TEST_2_ITEM_NAME,
			'author' 	=> 'fxbenard',
			)
		);

}
add_action( 'admin_init', 'test_2_plugin_updater', 0 );


$license = get_site_option( 'test_2_license_key' );
$status = get_site_option( 'test_2_license_status' );
if ( $license !== false && $status == 'valid' ) {

	// ADD YOUR STUFF HERE

}
