<?php
/**
 *  @package ClassAsService
 */

 namespace Inc;

class Init{
    //storing classes in an array 
    public static function get_services(){
        return [
            Pages\Admin::class,
            Base\SettingsLink::class,
            Base\Enqueue::class
        ];
    }

    // looping through the classes and initializing if register method exists
    public static function register_services(){
        foreach(self::get_services() as $class){
            $service = self::instantiate($class);
            if (method_exists($service, 'register')){
                $service->register();
            }
        }
    }
    //instantiating the classes
    private static function instantiate($class){
        $service = new $class();
        return $service;
    }
}







// class BookReg{
//     function __construct(){
//         $this->pass_data_to_db();   
//     }

//     static function create_table_to_db(){
//         global $wpdb;

//         $table_name = $wpdb->prefix.'books';
//         $book_details = "CREATE TABLE ".$table_name."(
//             title text NOT NULL,
//             author text NOT NULL,
//             publisher text NOT NULL
//         );";

//         // $book_details = "CREATE TABLE `ct_books` (title text NOT NULL, author text NOT NULL)";

//         require_once(ABSPATH.'wp-admin/includes/upgrade.php');
//         dbDelta($book_details);
//     }

//     function pass_data_to_db(){
//         if (isset($_POST['submitbtn'])){
//             $data = array(
//                 'title'=>$_POST['title'],
//                 'author'=>$_POST['author'],
//                 'publisher'=>$_POST['publisher']
//             );
//             global $wpdb;
//             $tableName= 'ct_books';
//             $result = $wpdb->insert($tableName, $data, $format=NULL);
        
//             if($result == true){
//                 echo "<script>alert('Book Registered Successfully');</script>";
//             }else{
//                 echo "<script>alert('Unable to Register');</script>";
//             }
//         }
//     }

//     public static function staticMethod(){
//         echo 'This is a static method';
//         BookReg::displayText();
//     }

//     static function displayText(){
//         echo 'This displays Text';
//     }

//     function activateExternally(){
//         Activate::activate();
//     }

//     function deactivateExternally(){
//         Deactivate::deactivate();
//     }
// }

// if (class_exists('BookReg')){
//     $bookRegInstance = new BookReg();
//     // BookReg::activateExternally();
// }

// //activation
// $bookRegInstance->activateExternally();

// //deactivate
// $bookRegInstance->deactivateExternally();

