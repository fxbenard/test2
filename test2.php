<?php
/**
 * Plugin Name:      EDD Test2
 * Plugin URI:      http://fxbenard.com/traductions/divi-builder-french
 * Description:     EDD Test2
 * Version: 2.0.0
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

// SECURITY : Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct acces not allowed!' );
}

// Define constants
if ( ! defined( 'TEST_2_STORE_URL' ) ) {
	define( 'TEST_2_STORE_URL', 'https://fxbenard.com' );
}
if ( ! defined( 'TEST_2_ITEM_NAME' ) ) {
	define( 'TEST_2_ITEM_NAME', 'Test2' );
}
// Plugin version
if ( ! defined( 'TEST_2_VER' ) ) {
	define( 'TEST_2_VER' , '2.0.0' );
}
// Plugin path
if ( ! defined( 'TEST_2_DIR' ) ) {
	define( 'TEST_2_DIR', plugin_dir_path( __FILE__ ) );
}
// Plugin URL
if ( ! defined( 'TEST_2_URL' ) ) {
	define( 'TEST_2_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! class_exists( 'TEST_2_Plugin_Updater' ) ) {
		// load our custom updater
		include( dirname( __FILE__ ) . '/includes/TEST_2_Plugin_Updater.php' );
}

function test_2_plugin_updater() {

	// retrieve our license key from the DB
		$license_key = trim( get_option( 'test_2_license_key' ) );

		// setup the updater
		$edd_updater = new TEST_2_Plugin_Updater( TEST_2_STORE_URL, __FILE__, array(
			'version' 	=> TEST_2_VER,
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => TEST_2_ITEM_NAME,
			'author' 	=> 'fxbenard',
			)
		);
}
add_action( 'admin_init', 'test_2_plugin_updater', 0 );


/************************************
 * the code below is just a standard
 * options page. Substitute with
 * your own.
 *************************************/

// IDEM ALL PLUGINS
if ( ! function_exists( 'fx_trads_license_menu' ) ) {
	function fx_trads_license_menu() {
		add_plugins_page( __( 'FX Trads', 'test2' ), __( 'FX Trads', 'test2' ), 'manage_options', 'fx-trads-license', 'fx_trads_license_page' );
	}

	add_action( 'admin_menu', 'fx_trads_license_menu' );
}

// IDEM ALL PLUGINS
if ( ! function_exists( 'fx_trads_license_page' ) ) {
	function fx_trads_license_page() { ?>
		<div class="wrap">
		<h2><?php _e( 'FX Trads License Options', 'test2' ); ?></h2>

		<form method="post" action="options.php">

			<?php do_action( 'fx_license_fields' );
			submit_button(); ?>
		</form>
		<?php
	}
}

function test_2_license_fields() {
	$license = get_option( 'test_2_license_key' );
	$status  = get_option( 'test_2_license_status' );

	settings_fields( 'test_2_license' );

	echo '<table class="form-table">
		<tbody>
		<tr valign="top">
			<th scope="row" valign="top">
				' . __( 'License Key for', 'test2' ) . ' ' . TEST_2_ITEM_NAME . '
			</th>
			<td>
				<input id="test_2_license_key" name="test_2_license_key" type="text"
				       class="regular-text"
				       value="' . esc_attr__( $license ) .'"/>
				<label class="description"
				       for="test_2_license_key">' . __( 'Enter your license key', 'test2' ) . '</label>
			</td>
		</tr>';
	if ( false !== $license ) :
		echo '<tr valign="top">
				<th scope="row" valign="top">
					' . __( 'Activate License', 'test2' ) . '
				</th>
				<td>';
		if ( $status !== false && $status == 'valid' ) :
			echo '<span style="color:green;">' . __( 'active', 'test2' ) . '</span>';
			wp_nonce_field( 'test_2_nonce', 'test_2_nonce' );
			echo '<input type="submit" class="button-secondary" name="test_2_license_deactivate"
						       value="' . __( 'Deactivate License', 'test2' ) . '"/>';
		else :
			wp_nonce_field( 'test_2_nonce', 'test_2_nonce' );
			echo '<input type="submit" class="button-secondary" name="test_2_license_activate"
						       value="' . __( 'Activate License', 'test2' ) . '"/>';
		endif;
		echo '</td>
			</tr>';
	endif;
	echo '
		</tbody>
	</table>';
}

add_action( 'fx_license_fields', 'test_2_license_fields' );

function test_2_register_option() {
	// creates our settings in the options table
	register_setting( 'test_2_license', 'test_2_license_key', 'test_2_sanitize_license' );
}

add_action( 'admin_init', 'test_2_register_option' );

function test_2_sanitize_license( $new ) {
	$old = get_option( 'test_2_license_key' );
	if ( $old && $old != $new ) {
		delete_option( 'test_2_license_status' ); // new license has been entered, so must reactivate
	}

	return $new;
}


/************************************
 * this illustrates how to activate
 * a license key
 *************************************/

function test_2_activate_license() {

	// listen for our activate button to be clicked
	if ( isset( $_POST['test_2_license_activate'] ) ) {

		// run a quick security check
		if ( ! check_admin_referer( 'test_2_nonce', 'test_2_nonce' ) ) {
			return; // get out if we didn't click the Activate button
		}
		// retrieve the license from the database
		$license = trim( get_option( 'test_2_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_name'  => urlencode( TEST_2_ITEM_NAME ), // the name of our product in EDD
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( add_query_arg( $api_params, TEST_2_STORE_URL ), array(
			'timeout'   => 15,
			'sslverify' => false,
			'body'      => $api_params,
		) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "valid" or "invalid"

		update_option( 'test_2_license_status', $license_data->license );

	}
}

add_action( 'admin_init', 'test_2_activate_license' );


/***********************************************
 * Illustrates how to deactivate a license key.
 * This will decrease the site count
 ***********************************************/

function test_2_deactivate_license() {

	// listen for our activate button to be clicked
	if ( isset( $_POST['test_2_license_deactivate'] ) ) {

		// run a quick security check
		if ( ! check_admin_referer( 'test_2_nonce', 'test_2_nonce' ) ) {
			return; // get out if we didn't click the Activate button
		}
		// retrieve the license from the database
		$license = trim( get_option( 'test_2_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_name'  => urlencode( TEST_2_ITEM_NAME ), // the name of our product in EDD
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( add_query_arg( $api_params, TEST_2_STORE_URL ), array(
			'timeout'   => 15,
			'sslverify' => false,
			'body'      => $api_params,
		) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if ( $license_data->license == 'deactivated' ) {
			delete_option( 'test_2_license_status' );
		}
	}
}

add_action( 'admin_init', 'test_2_deactivate_license' );


/************************************
 * this illustrates how to check if
 * a license key is still valid
 * the updater does this for you,
 * so this is only needed if you
 * want to do something custom
 *************************************/

function test_2_check_license() {

	global $wp_version;

	$license = trim( get_option( 'test_2_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license'    => $license,
		'item_name'  => urlencode( TEST_2_ITEM_NAME ),
		'url'        => home_url()
	);

	// Call the custom API.
	$response = wp_remote_get( add_query_arg( $api_params, TEST_2_STORE_URL ), array(
		'timeout'   => 15,
		'sslverify' => false,
		'body'      => $api_params,
	) );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if ( $license_data->license == 'valid' ) {
		echo 'valid';
		exit;
		// this license is still valid
	} else {
		echo 'invalid';
		exit;
		// this license is no longer valid
	}
}