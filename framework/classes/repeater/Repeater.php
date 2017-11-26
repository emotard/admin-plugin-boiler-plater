<?php

namespace RLFramework; 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Class Repeater{

    private $current_tab;
    public $label;

    function __construct(){

		if ( ! empty( $_GET['current_tab'] ) ) {
			$this->current_tab = $_GET['current_tab'];
		} else {
			$this->current_tab = 'general-settings';
		}

    }

    function make_repeater($repeater_options){
        // Get name of repeater 
        $repeater_name = $repeater_options['name'];
        // Get current saved options if any;
        $saved_options = rl_get_option($this->current_tab, remove_spaces(strtolower($repeater_options['id'])));
        // Count Current number of fields
        $count1 = count($repeater_options['fields']);
        // Count first number of saved fields
        $count2 = count($saved_options[0]);
        // Get Table id for sql search strip spaces and put to lowercase.
        $table_id =  strtolower(remove_spaces($repeater_options['id']));
       
        require 'repeater-table.php';

    }


    function text($options = '', $label = ''){

        if($label){
            $options['label'] = $label;
        }
        
        $html .= '<td>';
                $html .= '<input data-label="' . $options['label'] . '" data-type="text" class="input repeater-input" name="' . strtolower(remove_spaces($options['name'])) .'"placeholder="'. $options['placeholder'] . '" value="' . $options['value'] . '"></input>';
        $html .= '</td>';

        return $html;

    }

    function colour_picker($options = '', $label = ''){
        
        if($label){
            $options['label'] = $label;
        }

        $html .= '<td>';
        $html .= ' <input  data-label="' . $options['label'] . '" data-type="colour_picker" class="input repeater-input rl-colour-picker" id="rl-colour-picker" style="background-color: ' . $options['value'] . '" type="text" name="' . strtolower(remove_spaces($options['name'])) . '" value="' . $options['value'] . '"></input>';
        $html .= '</td>';

        return $html;

    }

    function select($options){

    }
    

}