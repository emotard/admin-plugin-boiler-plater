<?php


Class set_up_admin{
    
        public function __construct(){
    
            add_action( 'admin_menu', array($this, 'add_menu' ));
    
      
        }
    
        public function add_menu(){
            add_menu_page( PLUGIN_NAME, PLUGIN_NAME, 'manage_options', PLUGIN_SLUG, array($this, 'load_page'));
        }
    
        public function load_page(){

            require_once   RL_PLUGIN_PATH . 'framework/views/view-template.php';
  
        }
    
     }
    
     new set_up_admin();
    