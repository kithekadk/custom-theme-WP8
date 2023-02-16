<?php
/**
 *  @package BookRegistrationWithcomposer
 */

/*
    Plugin Name: Book Registration With Composer
    Plugin URI: http://.............
    Description: This is my book registration plugin With Composer
    Version: 1.0.0
    Author: Kitheka
    Author URI: http://kitheka.........
    Licence: GPLv2 or later
    Text Domain: book-registration-withcomposer
*/

/**
 * Securing A plugin
 */

defined('ABSPATH') or die('Hey you hacker, got you!');

//Adding Authload
if (file_exists(dirname(__FILE__).'/vendor/autoload.php')){
    require_once(dirname(__FILE__).'/vendor/autoload.php');
}

use Inc\Activate;
use Inc\Deactivate;
use Inc\Otherfile;

class BookReg{
    function __construct(){
        $this->pass_data_to_db();   
    }

    static function create_table_to_db(){
        global $wpdb;

        $table_name = $wpdb->prefix.'books';
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
        Activate::activate();
    }

    function deactivateExternally(){
        Deactivate::deactivate();
    }

    function errortrigger(){
        Otherfile::errortrigger();
    }
}

if (class_exists('BookReg')){
    $bookRegInstance = new BookReg();
    // BookReg::activateExternally();
}

//activation
$bookRegInstance->activateExternally();

//deactivate
$bookRegInstance->deactivateExternally();

$bookRegInstance->errortrigger();

