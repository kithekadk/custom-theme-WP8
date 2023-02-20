<?php
/**
 *  @package Cohort8
 */

namespace C8\Pages;

// use \C8\Base\BaseController;
use \C8\Api\SettingsApi;
use \C8\Api\Callbacks\AdminCallbacks;

class Admin{

    public $settings;
    public $callbacks;
    public $pages = array();
    public $subpages = array();


    function register(){
        $this->settings= new SettingsApi();
        $this->callbacks= new AdminCallbacks();
        $this->setPages();
        $this->setSubpages();
        $this->settings->AddPages($this->pages)->withSubpage()->addSubpages($this->subpages)->register();

        // add_action('admin_menu', array($this, 'add_admin_pages'));
    }


    public function setPages(){
        $this->pages=[
            [
            'page_title'=>'Cohort 8',
            'menu_title'=>'Cohort 8',
            'capability'=>'manage_options',
            'menu_slug'=>'cohort_8',
            'callback'=> array($this->callbacks,'Cohort8Main'),
            'icon_url'=>'dashicons-admin-site-alt',
            'position'=>111
            ],
            [
                'page_title'=>'Cohort 9',
                'menu_title'=>'Cohort 9',
                'capability'=>'manage_options',
                'menu_slug'=>'cohort_9',
                'callback'=>array($this->callbacks,'Cohort9Main'),
                'icon_url'=>'dashicons-admin-site-alt',
                'position'=>112
            ],
            [
                'page_title'=>'Cohort 10',
                'menu_title'=>'Cohort 10',
                'capability'=>'manage_options',
                'menu_slug'=>'cohort_10',
                'callback'=>array($this->callbacks,'Cohort10Main'),
                'icon_url'=>'dashicons-admin-site-alt',
                'position'=>113
            ]
    ];
    }

    public function setSubpages(){
        $this->subpages=array(
            array(
                'parent_slug'=>'cohort_8',
                'page_title'=>'Members',
                'menu_title'=>'Members',
                'capability'=>'manage_options',
                'menu_slug'=>'members',
                'callback'=>array($this->callbacks,'Cohort8members')
            ),
            array(
                'parent_slug'=>'cohort_8',
                'page_title'=>'Projects',
                'menu_title'=>'Projects',
                'capability'=>'manage_options',
                'menu_slug'=>'projects',
                'callback'=>array($this->callbacks,'Cohort8projects')
            ),
            array(
                'parent_slug'=>'cohort_8',
                'page_title'=>'Assessments',
                'menu_title'=>'Assessments',
                'capability'=>'manage_options',
                'menu_slug'=>'assessments',
                'callback'=>array($this->callbacks,'Cohort8Assessments')
            )
            );
    }
    // function add_admin_pages(){
    //     add_menu_page('Cohort 8', 'Cohort 8', 'manage_options', 'cohort_8', array($this, 'admin_index'), 'dashicons-admin-site-alt', 111);
    // }

    // function admin_index(){
    //     require_once $this->plugin_path . 'templates/main.php';  
    // }
}