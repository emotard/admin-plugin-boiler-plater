<?php

namespace RLFramework;

( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Class SetUpAdmin{
    
        public function __construct(){
    
            add_action( 'admin_menu', 
                array($this, 'add_menu' ));
            add_action( 'admin_enqueue_scripts', 
                array($this, 'load_custom_wp_admin_boilerplate_script' ));
    
        }

        /**
         * Enqueue the public CSS and scripts.
         *
         * @param $hook
         */
        
        /**
         * Enqueue the admin CSS and scripts.
         *
         * @param $hook
         */
        public function load_custom_wp_admin_boilerplate_script( $hook ) {
            
        if ( 'toplevel_page_' . PLUGIN_SLUG === $hook ) {
            
            wp_register_script( 'custom_wp_admin_colorpicker_js',
                RL_PLUGIN_URL . 'framework/assets/js/colorpicker.js',
                [ 'jquery' ] );
            wp_enqueue_script( 'custom_wp_admin_colorpicker_js' );
            
            wp_register_script( 'custom_wp_admin_boilerplate_js',
                RL_PLUGIN_URL . 'framework/assets/js/main.js',
                [ 'jquery', 'custom_wp_admin_colorpicker_js' ] );
            wp_enqueue_script( 'custom_wp_admin_boilerplate_js' );

            wp_register_script( 'custom_wp_admin_boilerplate_repeater_js',
                RL_PLUGIN_URL . 'framework/assets/js/repeater.js',
                [ 'jquery'] );
            wp_enqueue_script( 'custom_wp_admin_boilerplate_repeater_js' );
            
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
            wp_localize_script( 'custom_wp_admin_boilerplate_repeater_js', 'myAjax',
                [ 'ajaxurl' => admin_url( 'admin-ajax.php' ) ] );
            
            wp_register_style( 'custom_wp_admin_boilerplate_bulma_css',
                '//cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css' );
            wp_enqueue_style( 'custom_wp_admin_boilerplate_bulma_css' );
            
            wp_register_style( 'custom_wp_admin_boilerplate_font_awesome_css',
                '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
            wp_enqueue_style( 'custom_wp_admin_boilerplate_font_awesome_css' );
            
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

    public function add_menu(){
        add_menu_page( PLUGIN_NAME, PLUGIN_NAME, 'manage_options', PLUGIN_SLUG, array($this, 'load_page'));
    }
    
    public function load_page(){

        require_once   RL_PLUGIN_PATH . 'framework/views/view-template.php';
  
    }

    public static function runner()
    {
        new SetUpAdmin();
    }
    
}
