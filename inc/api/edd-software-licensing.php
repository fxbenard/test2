<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Make a http call to EDD software licensing API
 *
 * @since 1.2
 *
 * @param (string) $action (activate_license|check_license|delete_license)
 * @param (string)
 */
function edd_software_call( $action, $key ) {

	if ( $action == 'check_license' ) {
		$api_params = array(
			'edd_action' => $action,
			'license'    => $key,
			'item_name'  => urlencode( TEST_2_ITEM_NAME )

		);
	} else {
		$api_params = array(
			'edd_action' => $action,
			'license'    => $key,
			'item_name'  => urlencode( TEST_2_ITEM_NAME ), // the name of our product in EDD
			'url'        => home_url()
		);
	}

    $args = array(
      'timeout'   => 15,
      'sslverify' => false,
      'body'      => $api_params,
    );

    // Call the custom API.
    $remote_call = wp_remote_post( add_query_arg( $api_params, TEST_2_STORE_URL ), $args );

    // make sure the response came back okay
    if ( is_wp_error( $remote_call ) ) {
			$error_message = $remote_call->get_error_message();
			$response_code = wp_remote_retrieve_response_code( $remote_call );
   		return 'Something went wrong: '.$error_message . $response_code;
    }

    // decode the license data
    $license_data = json_decode( wp_remote_retrieve_body( $remote_call ) );

    return $license_data;

}
