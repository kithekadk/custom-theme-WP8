<?php
/**
 *  @package ClassAsService
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;

class Admin extends BaseController{

    function register(){
        add_action('admin_menu', array($this, 'add_admin_pages'));
    }

    function add_admin_pages(){
        add_menu_page('Class As Service', 'Class As Service', 'manage_options', 'class_as_service', array($this, 'admin_index'), 'dashicons-admin-generic', 110);
    }

    function admin_index(){
        require_once $this->plugin_path . 'templates/main.php';  
    }
}