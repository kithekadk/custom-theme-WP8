<?php
/**
 *  @package ClassAsService
 */

namespace Inc\Base;
use \Inc\Base\BaseController;

class SettingsLink extends BaseController{
    public function register(){
        add_filter("plugin_action_links_$this->plugin", [$this, 'settings_link']);
    }

    function settings_link($links){
        $new_link= '<a href="admin.php?page=class_as_service">Settings</a>';
        array_push($links, $new_link);
        return $links;
    }
}