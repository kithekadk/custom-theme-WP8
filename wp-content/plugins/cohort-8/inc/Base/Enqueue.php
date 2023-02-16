<?php
/**
 *   @package Cohort8
 */

 namespace C8\Base;
use \C8\Base\BaseController;

 class Enqueue extends BaseController{

   public function register(){
      add_action ('admin_enqueue_scripts' , array($this, 'enqueue')); 
   }
   function enqueue(){
    wp_enqueue_style('mypluginstyle', $this->plugin_url .'assets/mystyles.css', __FILE__);
    wp_enqueue_script('mypluginscript', $this->plugin_url .'assets/myscripts.js', __FILE__);
   }
}