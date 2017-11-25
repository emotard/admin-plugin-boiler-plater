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
		update_option( PLUGIN_SLUG . '-' . $key, $update );
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

	$save = [];

	foreach ( $data as $key => $value ) {

		rl_update_db($current_tab, $value['name'], $value['value']);

		$name = plugin_create_slug($value['name']);

		$save[ $name ] = stripslashes($value['value']);

    }
    
  //var_dump($save);

  	update_option( PLUGIN_SLUG . '-' . $current_tab, $save);
   
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
	global $wpdb;

	$table_name = $wpdb->prefix . 'rl_framework';

	$results = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE page = '".$page."' AND meta_key = '".$key."'");

	$uns = unserialize($results[0]->meta_value);


	if($uns){
		
		$results = $uns;
		
	}else{

		$results = $results[0]->meta_value;
		
	}

	return $results;

}


function rl_have_rows($page, $key){
	global $wpdb;
	$table_name = $wpdb->prefix . 'rl_framework';
	$results = $wpdb->get_results("SELECT meta_value FROM $table_name WHERE page = '".$page."' AND meta_key = '".$key."'");

	if(is_array($results)){
		return true;
	}

	return false;


}

function rl_the_row(){
	echo 'row';
}


function rl_update_db($current_tab, $key, $value){
	global $wpdb;

	if(is_array($value)){
		$value = serialize($value);
	}
	$table_name = $wpdb->prefix . 'rl_framework';

	$check = $wpdb->get_results("SELECT * FROM $table_name WHERE meta_key = '".$key."'");

	if($check){
		$wpdb->update( 
			$table_name, 
			array( 
				'page' => $current_tab,
				'meta_key' => $key,	
				'meta_value' => $value
			), 
			array( 'meta_key' => $key ), 
			array( 
				'%s',	// value1
				'%s'	// value2
			), 
			array( '%s' ) 
		);
	}else{
		$wpdb->insert($table_name, array(
			'page' => $current_tab,
			'meta_key' => $key,
			'meta_value' => $value,
		));
	}



}



