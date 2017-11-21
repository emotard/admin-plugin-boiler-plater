<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

register_activation_hook( RL_FILE, 'rl_framework_create_db_table' );

function rl_framework_create_db_table() {
    
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'rl_framework';
    
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        page varchar(2000000) NOT NULL,
        meta_key varchar(2000000) NOT NULL,
        meta_value varchar(2000000) NOT NULL,
        PRIMARY KEY id (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}