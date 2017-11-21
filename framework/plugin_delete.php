<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

register_deactivation_hook( RL_FILE, 'rl_framework_drop_db_table' );

function rl_framework_drop_db_table() {

    global $wpdb;
    $table_name = $wpdb->prefix . 'rl_framework';
    $sql = "DROP TABLE IF EXISTS $table_name";
    $wpdb->query($sql);

}