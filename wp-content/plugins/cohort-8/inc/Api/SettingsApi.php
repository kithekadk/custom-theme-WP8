<?php
/**
 *  @package Cohort8
 */

namespace C8\Api;

class SettingsApi{

    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();

    public function register(){
        if (!empty($this->admin_pages)){
            add_action('admin_menu', [$this, 'AddAdminMenu']);
        }
        if(!empty($this->settings)){
            add_action('admin_init', array($this, 'registerCustomFields'));
        }
    }

    public function AddPages(array $pages){
        $this->admin_pages = $pages;
        return $this;
    }

    public function withSubpage(string $title = 'Main'){
        if (empty($this->admin_pages)){
            return $this;
        }
        $admin_page = $this->admin_pages[0];
        $subpage = array(
            array(
                'parent_slug'=>$admin_page['menu_slug'],
                'page_title'=>$admin_page['page_title'],
                'menu_title'=>($title) ? $title : $admin_page['menu_title'],
                'capability'=>$admin_page['capability'],
                'menu_slug'=>$admin_page['menu_slug'],
                'callback'=>$admin_page['callback']
            )
        );

        $this->admin_subpages = $subpage;
        return $this;
    }

    public function addSubpages(array $pages){
        $this->admin_subpages =  array_merge($this->admin_subpages, $pages);
        return $this;
    }

    public function AddAdminMenu(){
        //page|menu
        foreach($this->admin_pages as $page){
            add_menu_page($page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position']);
        }

        //subpages|submenus
        foreach($this->admin_subpages as $page){
            add_submenu_page($page['parent_slug'],$page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'],$page['callback']);
        }
    }

    public function setSettings(array $settings){
        $this->settings = $settings;
        return $this;
    }

    public function setSections(array $sections){
        $this->sections = $sections;
        return $this;
    }

    public function setFields(array $fields){
        $this->fields = $fields;
        return $this;
    }

    public function registerCustomFields(){
        //register setting
        foreach($this->settings as $setting){
            register_setting($setting["option_group"], $setting["option_name"], (isset($setting["callback"]) ? $setting["callback"]:''));
        }
        //add settings sections
        foreach($this->sections as $section){
            add_settings_section($section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"]:''), $section["page"]);
        }
            //add settings fields
        foreach($this->fields as $field){
            add_settings_field($field["id"],$field["title"], (isset($field["callback"]) ? $field["callback"]:''), $field["page"], $field["section"], (isset($field["Args"])?$field["Args"]:''));
        }
    }
}