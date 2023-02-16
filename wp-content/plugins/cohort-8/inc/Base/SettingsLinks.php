<?php
/**
 *   @package Cohort8
 */

 namespace C8\Base;
 use \C8\Base\BaseController;

 class SettingsLinks extends BaseController{
    public function register(){
        add_filter("plugin_action_links_$this->plugin", [$this, 'settings_link']);
    }

    public function settings_link($links){
        $settings_link = '<a href="admin.php?page=cohort_8">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
 }