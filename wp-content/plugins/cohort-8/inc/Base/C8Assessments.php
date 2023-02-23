<?php
/**
 *  @package Cohort8
 */

namespace C8\Base;

class C8Assessments{
    public function register(){
        $this->create_table_assessment();
        $this->pass_data_to_assessment_table();
    }

    static function create_table_assessment(){
        global $wpdb;

        $table_name = $wpdb->prefix.'assessments';

        $assessment_details = "CREATE TABLE IF NOT EXISTS ".$table_name."(
            name text NOT NULL,
            phoneno int NOT NULL,
            email text NOT NULL,
            marks int NOT NULL,
            week int NOT NULL
        );";

        // $book_details = "CREATE TABLE `ct_books` (title text NOT NULL, author text NOT NULL)";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');
        dbDelta($assessment_details);
    }

    function pass_data_to_assessment_table(){
        if (isset($_POST['assessmentbtn'])){
            $data = array(
                'name'=>$_POST['name'],
                'phoneno'=>$_POST['phoneno'],
                'email'=>$_POST['email'],
                'marks'=>$_POST['marks'],
                'week'=>$_POST['week']
            );
            global $wpdb;
            $tableName= 'ct_assessments';
            $result = $wpdb->insert($tableName, $data, $format=NULL);
        
            if($result == true){
                echo "<script>alert('Asessment Submitted Successfully');</script>";
            }else{
                echo "<script>alert('Assessment submission failed');</script>";
            }
        }
    }
}