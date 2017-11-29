<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once 'plugin_activation.php';
require_once 'plugin_delete.php';

function process_boiler_plate_repeater_fields() {
	$data = $_POST['data'];
	
	$current_tab  = $_POST['current_tab'];
	$repeaterArray = [];
	$repeaters = $data[0];

	foreach($repeaters as $r_name => $value ){
		foreach($value as $key => $val){
			$repeaterArray[$r_name][] = $val; 
		}
	}
	$save = [];
	foreach($repeaterArray as $key => $value){
		$save[$key] = $value;
	}

	foreach($save as $key => $update){
		rl_update_db($current_tab, $key, $update);
	}
	
	wp_die();
}


add_action('wp_ajax_process_boiler_plate_repeater_fields', 
	'process_boiler_plate_repeater_fields');

/**
 * Update the options for the given page.
 */
function process_boiler_plate_page_fields() {
	$data = $_POST['data'];
	$current_tab  = $_POST['current_tab'];

	foreach ( $data as $key => $value ) {	

		$stripdata = stripslashes($value['value']);
		rl_update_db($current_tab, $value['name'], $stripdata);
	}
	
	wp_die();

}

add_action( 'wp_ajax_process_boiler_plate_page_fields',
	'process_boiler_plate_page_fields' );

/**
 * Global helper function to create route slugs. Should be namespaced so
 * replace plugin with whatever you decide to call the finished plugin.
 *
 * @param string $route_name
 *
 * @return string|void
 */
function plugin_create_slug( $route_name = '' ) {

	if ( ! empty( $route_name ) ) {
		$slug = strtolower( str_replace( " ", "-", $route_name ) );

		return $slug;
	}

	return;
}


function remove_spaces($name){
	
	$replace = str_replace(' ', '-', $name);
	
	return $replace;
	
}

function rl_get_option($page, $key){
	
	$results = rl_get_db_data($page, $key);

	if($results){
		return $results;
	}

	return false;

}

function rl_get_rows($page, $key){
	
	$results = rl_get_db_data($page, $key);

	$combine = [];

	foreach($results as $key => $value){
		
		$combine[$key] = [];

		foreach($value as $k => $v){
			$combine[$key][$v['label']] = $v['fields']['value'];
		}
	}

	if(is_array($combine)){
		return $combine; 
	}

	return false;
	
}


function rl_update_db($current_tab, $key, $value){
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'rl_framework';

	if(is_array($value)){
		$value = serialize($value);
	}

	$check_key = rl_check_if_key_exists($table_name, $current_tab, $key);

	if($check_key){
		$wpdb->update( 
			$table_name, 
			array( 
				'meta_key' => $key,	
				'meta_value' => $value
			), 
			array( 
				'page' => $current_tab,
				'meta_key' => $key
			), 
			array( 
				'%s',
				'%s'
			), 
			array( '%s', '%s' ) 
		);
	}else{
		$wpdb->insert($table_name, array(
			'page' => $current_tab,
			'meta_key' => $key,
			'meta_value' => $value,
		));
	}

}

function rl_get_db_data($page, $key){

	global $wpdb;
	
	$table_name = $wpdb->prefix . 'rl_framework';
	
	$sql = $wpdb->prepare("SELECT * FROM $table_name WHERE page = %s AND meta_key = %s", $page, $key);

	$results = $wpdb->get_results($sql, ARRAY_A);

	$sl = $results[0]['meta_value'];

	$uns = unserialize($sl);
	
	if($uns){
			
		$data = $uns;
			
	}else{
	
		$data = $sl;
			
	}
	return $data;

}

function rl_check_if_key_exists($table_name, $page, $key ) {
	
	global $wpdb;
	
	$sql = $wpdb->prepare("SELECT * FROM $table_name WHERE page = %s AND meta_key = %s", $page, $key);

	$check_key = $wpdb->get_results($sql, ARRAY_A);

	if($check_key){
		return true;
	}

	return false;

}

