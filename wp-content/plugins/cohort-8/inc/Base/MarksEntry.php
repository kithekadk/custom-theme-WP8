<?php
/**
 *   @package Cohort8
 */

namespace C8\Base;

class MarksEntry{
    public function register(){
        $this->marksEntryTable();
        $this->InsertMarks();
        // $this->DeleteTrainee();
        // $this->UpdateTrainee();
        // $this->getOneTrainee();
        // $this->getEmails();
        // $this->ReplaceTrainee();
    }

    static function marksEntryTable(){
        global $wpdb;

        $table_name = $wpdb->prefix.'marks';

        $marks_details="CREATE TABLE IF NOT EXISTS ".$table_name. "(
            name text NOT NULL,
            email text NOT NULL,
            attendance int NOT NULL, 
            project int NOT NULL
        );";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($marks_details);
    }

    function InsertMarks(){
        if(isset($_POST['btnsubmit1'])){
            $marks = array(
                'name'=>$_POST['name'],
                'email'=>$_POST['email'],
                'attendance'=>$_POST['attendance'],
                'project'=>$_POST['project']
            );
            global $wpdb;
            $table_name = $wpdb->prefix.'marks';
            $result = $wpdb->insert($table_name, $marks,$format=NULL);

            if($result == true){
                echo "<script>alert('Marks submitted successfully');</script>";
            }else{
                echo "<script>alert('Marks submission failed');</script>";
            }
        }
    }

    function DeleteTrainee(){
        global $wpdb;
        $table_name = $wpdb->prefix.'marks';

        $result = $wpdb->delete($table_name, array('email'=>'abc@gmail.com'));
        if($result == true){
            echo "<script>alert('Trainee deleted successfully');</script>";
        }else{
            echo "<script>alert('Deletion failed');</script>";
        }
    }

    function UpdateTrainee(){
        global $wpdb;
        $table_name = $wpdb->prefix.'marks';

        $result = $wpdb->update($table_name, ['name'=>'Jonah Kiptoo'], ['email'=>'abc@gmail.com']);
        if($result == true){
            echo "<script>alert('Update successful');</script>";
        }else{
            echo "<script>alert('Update failed');</script>";
        }
    }

    function getOneTrainee(){
        global $wpdb;
        $table_name = $wpdb->prefix.'marks';

        $result = $wpdb->get_row("SELECT * FROM $table_name WHERE email='gamesmy177@gmail.com'");
        print_r($result);
        if($result == true){
            echo "<script>alert('One Trainee Fetched');</script>";
        }else{
            echo "<script>alert('Fetch failed');</script>";
        }
    }

    function getEmails(){
        global $wpdb;
        $table_name = $wpdb->prefix.'marks';

        $result = $wpdb->get_col("SELECT email FROM $table_name");
        print_r($result);
        if($result == true){
            echo "<script>alert('Emails Fetched');</script>";
        }else{
            echo "<script>alert('Emails Fetch failed');</script>";
        }
    }

    function ReplaceTrainee(){
        global $wpdb;
        $table_name = $wpdb->prefix.'marks';

        $new_trainee= array(
            'name'=>'Wilson',
            'email'=>'wil@yopmail.com',
            'attendance'=>8,
            'project'=>9
        );
        $current_trainee= array(
            'name'=>'Daniel Kitheka',
            'email'=>'support@shiftech.co.ke',
        );
        $type = array(
            '%s',
            '%s',
            '%d',
            '%d'
        );
        $result = $wpdb->update($table_name, $new_trainee, $current_trainee);
        if($result == true){
            echo "<script>alert('Replacement Successfull');</script>";
        }else{
            echo "<script>alert('Replacement failed');</script>";
        }
    }
}