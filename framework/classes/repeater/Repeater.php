<?php

namespace RLFramework; 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Class Repeater{

    public $repeater_name;
    public $repeater_options;


    function __construct(){

    }

    function make_repeater($repeater_options){

        $this->repeater_name = $repeater_options['name'];

        $this->repeater_options = $repeater_options;

        $html .= '<table class="table plugin-repeater" id="' . strtolower(remove_spaces($this->repeater_options['id'])) .'">';
            $html .= '<thead><tr><th><h3>'.$this->repeater_name.'</h3></th></tr></thead>';
            $html .= '<tfoot><tr><th><button type="button" id="add-row" class="button is-primary add-row">Add Row</button></th></tr></tfoot>';
                $html .= '<tbody>';
                    $hmtl .= '<tr>';
                        foreach ($repeater_options['fields'] as $key => $option){

                            $html .= $this->$key($option);

                        };
                    $html .= '</tr>';   
                $html .= '</tbody>';
        $html .= '</table>';

        echo $html;

    }


    function text($options){
        
        $html .= '<td>';
                $html .= '<input data-type="text" class="input repeater-input" name="' . strtolower(remove_spaces($options['name'])) .'"placeholder="'. $options['placeholder'] . '" >';
        $html .= '</td>';

        return $html;

    }

    function colour_picker($options){
        $html .= '<td>';
        $html .= ' <input data-type="colour_picker" class="input repeater-input rl-colour-picker" id="rl-colour-picker" style="background-color: ' . $options['default'] . '" type="text" name="' . strtolower(remove_spaces($options['name'])) . '" value="' . $options['default'] . '"></input>';
        $html .= '</td>';

        return $html;

    }

    function select($options){

    }
    

}