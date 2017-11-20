<?php

function process_boiler_plate_repeater_fields() {
	$data = $_POST['data'];
	$repeaterArray = [];

	foreach($data as $key => $value){

		$repeaterArray[$value['Id']][] = [
			'Name' => $value['Name'],
			'Value' => $value['Value']
		];

	}

	$save = [];

	foreach($repeaterArray as $key => $value){

		$name = plugin_create_slug($key);
		$save[ $name ] = [];

		foreach($value as $val){

			$save[$name][$val['Name']] = $val['Value'];
		}

	}

	foreach($save as $key => $update){
		update_option( PLUGIN_SLUG . '-' . $key, $update );
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

		$name = plugin_create_slug($value['Name']);

		$save[ $name ] = stripslashes($value['Value']);

    }
    
  //var_dump($save);

	update_option( PLUGIN_SLUG . '-' . $current_tab, $save );

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



