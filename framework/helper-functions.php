<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once 'plugin_activation.php';
require_once 'plugin_delete.php';

/**
 * Process the repeater fields for the given page.
 */
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

	foreach($repeaterArray as $key => $value){
		rl_update_db($current_tab, $key, $value);
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
		$slug = strtolower(remove_spaces($route_name));

		return $slug;
	}

	return;
}



/**
 * Helper function to remove spaces and replace with
 * @return string
 */

function remove_spaces($name){
	
	$replace = str_replace(' ', '-', $name);
	
	return $replace;
	
}


/**
 * Helper function to get a single option
 *  @param string $page Current tab/page being passed
 *  @param string $key  which meta_key to get from the database 
 *  @return string|void
 */

function rl_get_option($page, $key){
	
	$results = rl_get_db_data($page, $key);

	if($results){
		return $results;
	}

	return false;

}


/**
 * Helper function to get repeater fields 
 *  @param string $page Current tab/page being passed
 *  @param string $key  which meta_key to get from the database 
 *  @return array|void
 */

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


/**
 * Helper function to update the database
 *  @param string $current_tab Current tab/page being passed
 *  @param string $key  which meta_key to get from the database 
 *  @param string $value to update in the db
 */

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

/**
 * Helper function to get current fields from the db
 *  @param string $page Current tab/page being passed
 *  @param string $key  which meta_key to get from the database
 *  @return array|string
 * 
 */

function rl_get_db_data($page, $key){

	global $wpdb;
	
	$table_name = $wpdb->prefix . 'rl_framework';
	
	$sql = $wpdb->prepare("SELECT * FROM $table_name WHERE page = %s AND meta_key = %s", $page, $key);

	$results = $wpdb->get_results($sql, ARRAY_A);

	$single = $results[0]['meta_value'];

	$or_array = unserialize($single);
	
	if($or_array){
			
		$data = $or_array;
			
	}else{
	
		$data = $single;
			
	}
	return $data;

}

/**
 * Helper function to check if the meta key is already in the database
 *  @param string $table_name Name of the db_table
 *  @param string $page Current tab/page being passed
 *  @param string $key  which meta_key to get from the database 
 *  @return string|void
 */

function rl_check_if_key_exists($table_name, $page, $key ) {
	
	global $wpdb;
	
	$sql = $wpdb->prepare("SELECT * FROM $table_name WHERE page = %s AND meta_key = %s", $page, $key);

	$check_key = $wpdb->get_results($sql, ARRAY_A);

	if($check_key){
		return true;
	}

	return false;

}

