<?php
/**
 *  @package Cohort8
 */

namespace C8\Pages;

use \C8\Base\BaseController;
use \C8\Api\SettingsApi;

class Admin extends BaseController{

    public $settings;
    public $pages = array();

    function __construct(){
        $this->settings= new SettingsApi();
        $this->pages=[
            [
            'page_title'=>'Cohort 8',
            'menu_title'=>'Cohort 8',
            'capability'=>'manage_options',
            'menu_slug'=>'cohort_8',
            'callback'=> function() {echo '<h1>Cohort 18</h1>';},
            'icon_url'=>'dashicons-admin-site-alt',
            'position'=>111
            ],
            [
                'page_title'=>'Cohort 9',
                'menu_title'=>'Cohort 9',
                'capability'=>'manage_options',
                'menu_slug'=>'cohort_9',
                'callback'=>function() {echo '<h1>Cohort 9</h1>';},
                'icon_url'=>'dashicons-admin-site-alt',
                'position'=>112
            ],
            [
                'page_title'=>'Cohort 10',
                'menu_title'=>'Cohort 10',
                'capability'=>'manage_options',
                'menu_slug'=>'cohort_10',
                'callback'=>function() {echo '<h1>Cohort 10</h1>';},
                'icon_url'=>'dashicons-admin-site-alt',
                'position'=>113
            ],
            [
                'jhgfghklj'
            ]
    ];
    }


    function register(){
        $this->settings->AddPages($this->pages)->register();

        // add_action('admin_menu', array($this, 'add_admin_pages'));
    }

    // function add_admin_pages(){
    //     add_menu_page('Cohort 8', 'Cohort 8', 'manage_options', 'cohort_8', array($this, 'admin_index'), 'dashicons-admin-site-alt', 111);
    // }

    // function admin_index(){
    //     require_once $this->plugin_path . 'templates/main.php';  
    // }
}