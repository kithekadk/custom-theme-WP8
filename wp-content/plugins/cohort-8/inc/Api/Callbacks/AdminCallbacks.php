<?php
/**
 *  @package Cohort8
 */

namespace C8\Api\Callbacks;
use C8\Base\BaseController;

class AdminCallbacks extends BaseController{
    public function Cohort8Main(){
        return require_once("$this->plugin_path/templates/cohort8main.php");
    }
    public function Cohort9Main(){
        return require_once("$this->plugin_path/templates/cohort9main.php");
    }
    public function Cohort10Main(){
        return require_once("$this->plugin_path/templates/cohort10main.php");
    }
    public function Cohort8members(){
        return require_once("$this->plugin_path/templates/cohort8members.php");
    }
    public function Cohort8projects(){
        return require_once("$this->plugin_path/templates/cohort8projects.php");
    }
    public function Cohort8Assessments(){
        return require_once("$this->plugin_path/templates/cohort8assessment.php");
    }
    public function Cohort9Assessments(){
        return require_once("$this->plugin_path/templates/cohort9assessments.php");
    }
    public function Cohort9Members(){
        return require_once("$this->plugin_path/templates/cohort9members.php");
    }
    public function Cohort9Projects(){
        return require_once("$this->plugin_path/templates/cohort9projects.php");
    }
    public function Cohort10MarksEntry(){
        return require_once("$this->plugin_path/templates/marksentry.php");
    }
    public function cohort8OptionsGroup($input){
        return $input;
    }
    public function cohort8AdminSection(){
        echo 'This is the first section';
    }
    public function cohort8TextExample(){
        $value = esc_attr(get_option('cohort_8_example'));
        echo '<input type="text" class="regular-text" name="cohort_8_example" value="'.$value.'" placeholder="Write Your First Name"';
    }
    public function cohort8SecondName(){
        $value = esc_attr(get_option('second_name'));
        echo '<input type="text" class="regular-text" name="second_name" value="'.$value.'" placeholder="Write Your Second Name"';
    }
}