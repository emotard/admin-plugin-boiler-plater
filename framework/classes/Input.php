<?php

namespace RLFramework;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Input {

	/**
	 * @var string The active tab.
	 */
	private $current_tab;

	/**
	 * @var mixed The options for the active page.
	 */
	private $page_options;

	public function __construct() {

		if ( ! empty( $_GET['current_tab'] ) ) {
			$this->current_tab = $_GET['current_tab'];
		} else {
			$this->current_tab = 'general-settings';
		}

		$this->page_options = get_option( PLUGIN_SLUG . '-' . $this->current_tab );
	}

	/**
	 * Create a text input field.
	 *
	 * @param string $name
	 */
	public function make_input_text( $name ) {

		$value = rl_get_option($this->current_tab, $name);

		$name = strtolower(remove_spaces( $name ));

		echo '<div class="control"><input class="input normal-input" type="text" name="' . $name . '" value="' . $value . '"></input></div>';

	}

	/**
	 * Create a textarea input field.
	 *
	 * @param string $name
	 */
	public function make_input_textarea( $name ) {

		$value = rl_get_option($this->current_tab, $name);

		$name = strtolower(remove_spaces( $name ));

		echo '<textarea class="textarea normal-textarea" name="' . $name . '" form="' . $this->current_tab . '">' . $value . '</textarea>';
	}

	/**
	 * Create a tinyMCE input field.
	 *
	 * @param string $name
	 */
	public function make_input_tinymce( $name ) {

		$value = rl_get_option($this->current_tab, $name);

		$name = strtolower(remove_spaces( $name ));

		echo '<textarea class="textarea normal-textarea tinymce-textarea" name="' . $name . '" form="' . $this->current_tab . '">' . $value  . '</textarea>';
	}

	/**
	 * Create a select input field.
	 *
	 * @param string $name
	 * @param array  $options
	 */
	public function make_input_select( $name, $options = [] ) {

		$value = rl_get_option($this->current_tab, $name);

		$html = "";

		$name = strtolower(remove_spaces( $name ));

		$html .= '<div class="control">
                    <div class="select">';
		$html .= '<select class="normal-select" name="' . $name . '" form="' . $this->current_tab . '">';
		$html .= '<option value="">Select Option</option>';
		foreach ( $options as $key => $option ) {
			$html .= '<option value="' . $option . '"' . ( $value == $option ? 'selected="selected"' : '' ) . '">' . ucfirst( $option ) . '</option>';
		}

		$html .= '</select>';
		$html .= '</div>
                    </div>';

		echo $html;


	}

	/**
	 * Generate a colour picker input field.
	 *
	 * @param string $name
	 */
	public function make_input_colour_picker( $name ) {

		$value = rl_get_option($this->current_tab, $name);

		$name = plugin_create_slug( $name );

		echo '<div class="control"><input class="input normal-input rl-colour-picker" id="rl-colour-picker" style="background-color: ' . $value . '" type="text" name="' . $name . '" value="' . $value . '"></input></div>';

    }
    
}
