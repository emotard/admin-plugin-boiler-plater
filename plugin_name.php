<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// TODO: Change the header to match your details
/**
 * Plugin Name: Plugin Skeleton
 * Description: Not a real plugin, but rather a starting point for building other plugins
 * Version: 1.0
 * Author: Robert Leigh
 * Author URI: #
 */


require_once 'framework/helper-functions.php';

require_once( 'vendor/autoload.php' );
RLFramework\SetUpAdmin::runner();
define( 'PLUGIN_NAME', 'New Plugin' );
$url = plugin_create_slug(PLUGIN_NAME);
define( 'PLUGIN_SLUG', $url );
define( 'RL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'RL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



 