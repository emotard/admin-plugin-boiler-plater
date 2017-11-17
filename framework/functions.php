<?php

/**
 * Enqueue the admin CSS and scripts.
 *
 * @param $hook
 */
function load_custom_wp_admin_boilerplate_script( $hook ) {

	if ( 'toplevel_page_' . PLUGIN_SLUG === $hook ) {

		wp_register_script( 'custom_wp_admin_colorpicker_js',
			RL_PLUGIN_URL . 'framework/assets/js/colorpicker.js',
			[ 'jquery' ] );
		wp_enqueue_script( 'custom_wp_admin_colorpicker_js' );

		wp_register_script( 'custom_wp_admin_boilerplate_js',
			RL_PLUGIN_URL . 'framework/assets/js/main.js',
			[ 'jquery', 'custom_wp_admin_colorpicker_js' ] );
		wp_enqueue_script( 'custom_wp_admin_boilerplate_js' );

		wp_register_script( 'custom_wp_admin_boilerplate_tinymce_js',
			RL_PLUGIN_URL . 'framework/assets/js/tinymce/tinymce.min.js',
			[ 'jquery' ] );
		wp_enqueue_script( 'custom_wp_admin_boilerplate_tinymce_js' );

		wp_register_script( 'custom_wp_admin_boilerplate_user_js',
			RL_PLUGIN_URL . '/assets/admin.js', [ 'jquery' ] );
		wp_enqueue_script( 'custom_wp_admin_boilerplate_user_js' );

		wp_localize_script( 'custom_wp_admin_boilerplate_js', 'myAjax',
			[ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
		wp_localize_script( 'custom_wp_admin_boilerplate_user_js', 'myAjax',
			[ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ] );

		wp_register_style( 'custom_wp_admin_boilerplate_bulma_css',
			'//cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css' );
		wp_enqueue_style( 'custom_wp_admin_boilerplate_bulma_css' );

		wp_register_style( 'custom_wp_admin_colorpicker_css',
			RL_PLUGIN_URL . 'framework/assets/css/colorpicker.css' );
		wp_enqueue_style( 'custom_wp_admin_colorpicker_css' );

		wp_register_style( 'custom_wp_admin_boilerplate_css',
			RL_PLUGIN_URL . 'framework/assets/css/main.css' );
		wp_enqueue_style( 'custom_wp_admin_boilerplate_css' );

		wp_register_style( 'custom_wp_admin_boilerplate_user_css',
			RL_PLUGIN_URL . '/assets/styles.css' );
		wp_enqueue_style( 'custom_wp_admin_boilerplate_user_css' );

		wp_enqueue_media();

	}


}

add_action( 'admin_enqueue_scripts',
	'load_custom_wp_admin_boilerplate_script' );

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
    
    var_dump($save);

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



