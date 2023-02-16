<?php
/**
 *  @package ClassAsService
 */

/*
    Plugin Name: Class As Service
    Plugin URI: http://.............
    Description: This is a class as service plugin With Composer
    Version: 1.0.0
    Author: Kitheka
    Author URI: http://kitheka.........
    Licence: GPLv2 or later
    Text Domain: class-as-service
*/

/**
 * Securing A plugin
 */

defined('ABSPATH') or die('Hey you hacker, got you!');

//Adding Autoload
if (file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once(dirname(__FILE__).'/vendor/autoload.php');
}

function activate_class_plugin(){
    Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_class_plugin');

function deactivate_class_plugin(){
    Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_class_plugin');

if (class_exists('Inc\\Init')){
    Inc\Init::register_services();
}