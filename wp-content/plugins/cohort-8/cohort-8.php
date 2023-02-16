<?php
/**
 *  @package Cohort8
 */

/*
    Plugin Name: Cohort 8 WP
    Plugin URI: http://.............
    Description: This is cohort 8 plugin
    Version: 1.0.0
    Author: Kitheka
    Author URI: http://kitheka.........
    Licence: GPLv2 or later
    Text Domain: cohort-8
*/

/**
 * Securing A plugin
 */

defined('ABSPATH') or die('Hey you hacker, got you!');

if (file_exists(dirname(__FILE__). '/vendor/autoload.php')){
    require_once (dirname(__FILE__). '/vendor/autoload.php');
}
//activation
function activate_c8_plugin(){
    C8\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_c8_plugin');

//deactivation
function deactivate_c8_plugin(){
    C8\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_c8_plugin');

if (class_exists('C8\\Init')){
    C8\Init::register_services();
}