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

define('RL_FILE', __FILE__);
define( 'PLUGIN_NAME', 'New Plugin' );
define( 'PLUGIN_SLUG', 'new-plugin');
define( 'RL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'RL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once 'framework/helper-functions.php';

require_once( 'vendor/autoload.php' );
RLFramework\SetUpAdmin::runner();




 