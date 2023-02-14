<?php
/**
 *  @package ContactUs
 */

/**
 * Plugin Name: Contact Us Plugin - C8
 * Plugin URI: http://github.......
 * Description: This is my first plugin
 * Version: 1.0.0
 * Author: Cohort 8 WP
 * Author URI: http://cohort8....
 * Licence: GPLv2 or later
 * Text Domain: contact-plugin
 */

 //security check
 if (!defined('ABSPATH')){
    die;
 }

 if (!class_exists('ContactUs')){
 class ContactUs{
    function __construct(){
        $this->pass_data_to_db();
    }

    function activate(){
        $this->create_table_to_db();
        flush_rewrite_rules();
    }

    function deactivate(){
        flush_rewrite_rules();
    }

    function create_table_to_db(){
        global $wpdb;

        $table_name = $wpdb->prefix.'contactus';
        $charset = $wpdb->get_charset_collate();

        $contactus= "CREATE TABLE ".$table_name."(
            name text NOT NULL,
            email text NOT NULL,
            message text NOT NULL
        )$charset;";

        // $contactus = "CREATE TABLE `ct_contactus` (name text NOT NULL,email text NOT NULL,message text NOT NULL )";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($contactus);
    }

    function pass_data_to_db(){
        if (isset($_POST['submitmsg'])){
        $data = array(
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'message'=>$_POST['message']
        );

        global $wpdb;
        $table_name= $wpdb->prefix.'contactus';
        $result = $wpdb->insert($table_name, $data, $format=NULL);

        if($result == true){
            echo "<script>alert('Message sent successfully');</script>";
        }else{
            echo "<script>alert('Message not sent');</script>";
        }
    }
    }
 }

$contactUsInstance= new ContactUs();

//activate
register_activation_hook(__FILE__, array($contactUsInstance,'activate'));

//deactivate
register_deactivation_hook(__FILE__, array($contactUsInstance,'deactivate'));

}