<?php
/**
 *  @package ClassAsService
 */

 namespace Inc\Base;
 
 class Deactivate{
    static function deactivate(){
        flush_rewrite_rules();
    }
 }