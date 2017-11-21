<?php

namespace RLFramework;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Class Route {

	/**
	 * Create a new top level navigation tab.
	 *
	 * @param string $route_name
	 * @param string $tab_title
	 * @param string $icon_class
	 */
	public function make_route( $route_name, $tab_title, $icon_class = "") {

		if ( ! empty( $_GET['current_tab'] ) ) {
			$this->current_tab = $_GET['current_tab'];
		} else {
			$this->current_tab = 'general-settings';
		}

        	$slug = plugin_create_slug( $route_name );
        
		$class = ( $this->current_tab == $slug ) ? ' is-active' : '';

		echo "<li class=" . $class . "><a class='$class' href='?page=" . PLUGIN_SLUG . "&current_tab=$slug'><span class='$icon_class'></span>$tab_title</a></li>";

	}

}
