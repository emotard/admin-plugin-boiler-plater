<?php

namespace RLFramework; 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Class Repeater{

    private $current_tab;

    function __construct(){

		if ( ! empty( $_GET['current_tab'] ) ) {
			$this->current_tab = $_GET['current_tab'];
		} else {
			$this->current_tab = 'general-settings';
		}

    }

    function make_repeater($repeater_options){

        $repeater_name = $repeater_options['name'];

        $saved_options = rl_get_option($this->current_tab, remove_spaces(strtolower($repeater_options['id'])));


        $count1 = count($repeater_options['fields']);
        $count2 = count($saved_options[0]['fields']);

        $table_id =  strtolower(remove_spaces($repeater_options['id']));
       
     

        $html .= '<table class="table plugin-repeater" id="' . $table_id  .'">';
            $html .= '<thead><tr><th><h3>'. $repeater_name .'</h3></th></tr></thead>';
            $html .= '<tfoot><tr><th><button type="button" id="add-row" class="button is-primary add-row">Add Row</button></th></tr></tfoot>';
                $html .= '<tbody>';
                            if($repeater_options['headers']){
                                $html .= '<tr class="header-row">';
                                    foreach($repeater_options['headers'] as $header){
                                        $html .= '<td>'.$header.'</td>';
                                    }
                                $html .= '</tr>';
                            }
                            if($saved_options){
                            
                                foreach ($repeater_options['fields'] as $key => $options){
                                    
                                        $saved_results = $saved_options[$options['label']];
                                    
                                        echo '<pre>' . var_export($saved_results, true) . '</pre>';
                                                                        
                                 };
                                 
                            }else{
                                $hmtl .= '<tr>';
                                foreach ($repeater_options['fields'] as $key => $options){

                                        $run = $options['type'];
                                        $html .= $this->$run($options);
                                    
                                };
                                $html .= '<td class="remove-row">X</td>';
                                $html .= '</tr>';   
                            }
                $html .= '</tbody>';
        $html .= '</table>';

        echo $html;

    }


    function text($options = ''){
        
        $html .= '<td>';
                $html .= '<input data-label="' . $options['label'] . '" data-type="text" class="input repeater-input" name="' . strtolower(remove_spaces($options['name'])) .'"placeholder="'. $options['placeholder'] . '" value="' . $options['value'] . '"></input>';
        $html .= '</td>';

        return $html;

    }

    function colour_picker($options = ''){
        $html .= '<td>';
        $html .= ' <input  data-label="' . $options['label'] . '" data-type="colour_picker" class="input repeater-input rl-colour-picker" id="rl-colour-picker" style="background-color: ' . $options['value'] . '" type="text" name="' . strtolower(remove_spaces($options['name'])) . '" value="' . $options['value'] . '"></input>';
        $html .= '</td>';

        return $html;

    }

    function select($options){

    }
    

}