<?php
/**
 *  @package ContactUsWithAdminPage
 */

/**
 * Plugin Name: Contact Us With Admin Page
 * Plugin URI: http://github.......
 * Description: This is my first plugin With Admin Page
 * Version: 1.0.0
 * Author: Cohort 8 WP
 * Author URI: http://cohort8....
 * Licence: GPLv2 or later
 * Text Domain: contact-plugin-with-adminpage
 */

 //security check
 if (!defined('ABSPATH')){
    die;
 }

 if (!class_exists('ContactUsWithAdminPage')){
 class ContactUsWithAdminPage{
    function __construct(){
        $this->plugin = plugin_basename(__FILE__);
    }

    function activate(){
        flush_rewrite_rules();
    }

    function deactivate(){
        flush_rewrite_rules();
    }
    public $plugin;
    function register(){
        add_action('admin_menu', array($this, 'add_admin_pages'));

        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
    }

    function settings_link($links){
        $settings_link = '<a href="admin.php?page=contact_plugn">Settings</a>';

        array_push($links, $settings_link);
        return $links;
    }

    function add_admin_pages(){
        add_menu_page('Contact Us ADMIN', 'Contact Us', 'manage_options', 'contact_plugn', array($this, 'admin_index'), 'dashicons-image-filter', 110);
    }

    function admin_index(){
        require_once plugin_dir_path(__FILE__).'templates/main.php';
    }


    }
 

$contactUsInstance= new ContactUsWithAdminPage();
$contactUsInstance->register();
//activate
register_activation_hook(__FILE__, array($contactUsInstance,'activate'));

//deactivate
register_deactivation_hook(__FILE__, array($contactUsInstance,'deactivate'));

}