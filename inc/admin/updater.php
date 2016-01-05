<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

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
