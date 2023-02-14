<?php
/**
 *  @package BookRegistration
 */

/*
    Plugin Name: Book Registration
    Plugin URI: http://.............
    Description: This is my book registration plugin
    Version: 1.0.0
    Author: Kitheka
    Author URI: http://kitheka.........
    Licence: GPLv2 or later
    Text Domain: book-registration
*/

/**
 * Securing A plugin
 */

defined('ABSPATH') or die('Hey you hacker, got you!');



class BookReg{
    function __construct(){
        $this->pass_data_to_db();   
    }

    static function create_table_to_db(){
        global $wpdb;

        $table_name = $wpdb->prefix.'books';
        // $charset = $wpdb->get_charset_collate();

        $book_details = "CREATE TABLE ".$table_name."(
            title text NOT NULL,
            author text NOT NULL,
            publisher text NOT NULL
        );";

        // $book_details = "CREATE TABLE `ct_books` (title text NOT NULL, author text NOT NULL)";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($book_details);
    }

    function pass_data_to_db(){
        if (isset($_POST['submitbtn'])){
            $data = array(
                'title'=>$_POST['title'],
                'author'=>$_POST['author'],
                'publisher'=>$_POST['publisher']
            );
            global $wpdb;
            $tableName= 'ct_books';
            $result = $wpdb->insert($tableName, $data, $format=NULL);
        
            if($result == true){
                echo "<script>alert('Book Registered Successfully');</script>";
            }else{
                echo "<script>alert('Unable to Register');</script>";
            }
        }
    }

    public static function staticMethod(){
        echo 'This is a static method';
        BookReg::displayText();
    }

    static function displayText(){
        echo 'This displays Text';
    }

    function activateExternally(){
        require_once plugin_dir_path(__FILE__). 'inc/book-registration-activate.php';
        BookRegActivate::activate();
    }

    function deactivateExternally(){
        require_once plugin_dir_path(__FILE__). 'inc/book-registration-deactivate.php';
        BookRegDectivate::deactivate();
    }
}

if (class_exists('BookReg')){
    $bookRegInstance = new BookReg();
    // BookReg::activateExternally();
}

//activation
$bookRegInstance->activateExternally();
// register_activation_hook(__FILE__, array($bookRegInstance,'activateExternally'));
// register_activation_hook(__FILE__, array($bookRegInstance, 'activate'));
// require_once plugin_dir_path(__FILE__). 'inc/book-registration-activate.php';
// register_activation_hook(__FILE__, array('BookRegActivate', 'activate'));

//deactivate
$bookRegInstance->deactivateExternally();
// register_deactivation_hook(__FILE__, array($bookRegInstance, 'deactivate'));
// require_once plugin_dir_path(__FILE__). 'inc/book-registration-deactivate.php';
// register_deactivation_hook(__FILE__, array('BookRegDectivate','deactivate'));

//
// register_uninstall_hook(__FILE__, array($bookRegInstance, 'uninstall'));