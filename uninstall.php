<?php

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

$option_name = 'ph_prot_options';

delete_option( $option_name );

// For site options in multisite
delete_site_option( $option_name );

//drop a custom db table
//global $wpdb;
//$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}ph_prot_table" );
