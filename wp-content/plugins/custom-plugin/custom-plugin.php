<?php
/**
 *  @package CustomPlugin
 */

/*
    Plugin Name: Custom Plugin
    Plugin URI: http://.............
    Description: This is my first plugin
    Version: 1.0.0
    Author: Kitheka
    Author URI: http://kitheka.........
    Licence: GPLv2 or later
    Text Domain: custom-plugin
*/

/**
 * Securing A plugin
 */
//method 1
if (!defined ('ABSPATH')){
    die;
}

//method 2
defined('ABSPATH') or die('Hey you hacker, got you!');

//method 3
if (!function_exists('add_action')){
    echo 'Hey you hacker, got you!';
    exit;
}

class CustomPlugin{
    function __construct(){
        // echo $string;
        add_action('init', array($this, 'custom_post_type'));
    }

    function activate(){
        // flush rewrite rules
        // echo 'The Plugin was activated';
        flush_rewrite_rules();
    }

    function deactivate(){
        // flush rewrite rules
        flush_rewrite_rules();
    }

    static function uninstall(){

    }

    function custom_post_type(){
        register_post_type('book', ['public'=>true, 'label'=>'Books']);
    }
}

if (class_exists('CustomPlugin')){
    $customPluginInstance = new CustomPlugin();
}

//activation
register_activation_hook(__FILE__, array($customPluginInstance, 'activate'));

//deactivate
register_deactivation_hook(__FILE__, array($customPluginInstance, 'deactivate'));

//
// register_uninstall_hook(__FILE__, array($customPluginInstance, 'uninstall'));