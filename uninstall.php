<?php

// If uninstall not called from WordPress exit
defined( 'WP_UNINSTALL_PLUGIN' ) or die( 'Cheatin&#8217; uh?' );

// Delete plugin transients
delete_site_transient( '_test_2_license_data' );
delete_site_transient( '_test_2_license_error' );

// Delete plugin options
delete_site_option( 'test_2_license_key' );
delete_site_option( 'test_2_license_status' );
