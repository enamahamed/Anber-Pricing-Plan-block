<?php
/*
Plugin Name: WP Anber Pricing Plan 
Plugin URI: https://github.com/enamahamed/Anber-Pricing-Plan-block
Description: WP Anber Pricing Plan 
Version: 1.1.1
Author: MD Enam Ahamed Chowdhury
Author URI: https://github.com/enamahamed
Text Domain: wpfs
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
define('WPAPP_CORE_INC', dirname(__FILE__) . '/assets/inc/');

// Load the Carbonfield
if (!file_exists(WPAPP_CORE_INC . '/vendor/autoload.php')) {
    require_once WPAPP_CORE_INC . '/vendor/autoload.php';
}



// Load the Carbonfield
if (file_exists(WPAPP_CORE_INC . '/wapp-core-functions.php')) {
    require_once WPAPP_CORE_INC . '/wapp-core-functions.php';
}

add_action( 'enqueue_block_assets', function() {
    wp_enqueue_style( 'carbon-fields-block-style', plugin_dir_url( __FILE__ ) . '/assets/css/wpapp-block-style.css' );
} );


// Update Chacker
//if (file_exists(WPAPP_CORE_INC . '/plugin-update-checker/plugin-update-checker.php')) {
//    require_once WPAPP_CORE_INC . '/plugin-update-checker/plugin-update-checker.php';
//}
require WPAPP_CORE_INC . 'plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/Frahim/WP-Anber-Pricing-Plan',
	__FILE__, //Full path to the main plugin file or functions.php.
	'WP-Anber-Pricing-Plan'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

