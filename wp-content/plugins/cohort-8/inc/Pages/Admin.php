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

        $this->createSettings();
        $this->createSections();
        $this->createFields();

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
            ),
            array(
                'parent_slug'=>'cohort_9',
                'page_title'=>'Assessments',
                'menu_title'=>'Assessments',
                'capability'=>'manage_options',
                'menu_slug'=>'assessments_9',
                'callback'=>array($this->callbacks,'Cohort9Assessments')
            ),
            array(
                'parent_slug'=>'cohort_9',
                'page_title'=>'Members',
                'menu_title'=>'Members',
                'capability'=>'manage_options',
                'menu_slug'=>'members_9',
                'callback'=>array($this->callbacks,'Cohort9Members')
            ),
            array(
                'parent_slug'=>'cohort_9',
                'page_title'=>'Projects',
                'menu_title'=>'Projects',
                'capability'=>'manage_options',
                'menu_slug'=>'projects_9',
                'callback'=>array($this->callbacks,'Cohort9Projects')
            ),
            array(
                'parent_slug'=>'cohort_10',
                'page_title'=>'Mark Entry',
                'menu_title'=>'Marks Entry',
                'capability'=>'manage_options',
                'menu_slug'=>'marks_entry',
                'callback'=>array($this->callbacks,'Cohort10MarksEntry')
            )
            );
    }
//    public function 
    public function createSettings(){
        $params =[
            [
                'option_group'=>'cohort_8_group',
                'option_name'=>'cohort_8_example',
                'callback'=> [$this->callbacks,'cohort8OptionsGroup']
            ],
            [
                'option_group'=>'cohort_8_group',
                'option_name'=>'second_name'
            ]
        ];

        $this->settings->setSettings($params);
    }

    public function createSections(){
        $params = [
            [
                'id'=>'cohort_8_admin_index',
                'title'=>'Members',
                'callback'=>[$this->callbacks, 'cohort8AdminSection'],
                'page'=>'cohort_8'
            ]
        ];
        $this->settings->setSections($params);
    }

    public function createFields(){
        $params = [
            [
                'id'=>'cohort_8_example',//get from createSettings
                'title'=>'First Name',
                'callback'=> [$this->callbacks, 'cohort8TextExample'],
                'page'=>'cohort_8',//menu slug
                'section'=>'cohort_8_admin_index', //section id from create sections
                'Args'=>[
                    'label_for'=>'cohort_8_example',
                    'class'=>'example-class'
            ]
            ],
            [
                'id'=>'second_name',//get from createSettings
                'title'=>'Second Name',
                'callback'=> [$this->callbacks, 'cohort8SecondName'],
                'page'=>'cohort_8',//menu slug
                'section'=>'cohort_8_admin_index', //section id from create sections
                'Args'=>[
                    'label_for'=>'second_name',
                    'class'=>'example-class'
                ]
            ]
        ];

        $this->settings->setFields($params);
    }
}