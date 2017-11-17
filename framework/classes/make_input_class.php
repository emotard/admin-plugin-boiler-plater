<?php

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

		$name = strtolower($this->remove_spaces( $name ));

		echo '<div class="control"><input class="input" type="text" name="' . $name . '" value="' . $this->page_options[ $name ] . '"></input></div>';

	}

	/**
	 * Create a textarea input field.
	 *
	 * @param string $name
	 */
	public function make_input_textarea( $name ) {

		$name = strtolower($this->remove_spaces( $name ));

		echo '<textarea class="textarea" name="' . $name . '" form="' . $this->current_tab . '">' . $this->page_options[ $name ] . '</textarea>';
	}

	/**
	 * Create a tinyMCE input field.
	 *
	 * @param string $name
	 */
	public function make_input_tinymce( $name ) {

		$name = strtolower($this->remove_spaces( $name ));

		echo '<textarea class="textarea tinymce-textarea" name="' . $name . '" form="' . $this->current_tab . '">' . $this->page_options[ $name ]  . '</textarea>';
	}

	/**
	 * Create a select input field.
	 *
	 * @param string $name
	 * @param array  $options
	 */
	public function make_input_select( $name, $options = [] ) {

		$html = "";

		$name = strtolower($this->remove_spaces( $name ));

		$html .= '<div class="control">
                    <div class="select">';
		$html .= '<select name="' . $name . '" form="' . $this->current_tab . '">';
		$html .= '<option value="">Select Option</option>';
		foreach ( $options as $key => $option ) {
			$html .= '<option value="' . $option . '"' . ( $this->page_options[ $name ] == $option ? 'selected="selected"' : '' ) . '">' . ucfirst( $option ) . '</option>';
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

		$name = plugin_create_slug( $name );

		echo '<div class="control"><input class="input" id="rl-color-picker" style="background-color: ' . $this->page_options[ $name ] . '" type="text" name="' . $name . '" value="' . $this->page_options[ $name ] . '"></input></div>';

    }
    
    private function remove_spaces($name){
        
        $replace = str_replace(' ', '-', $name);
        
        return $replace;
        
    }
}
