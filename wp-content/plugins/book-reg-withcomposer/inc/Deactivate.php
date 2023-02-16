<?php
/**
 *  @package BookRegistrationWithcomposer
 */

 namespace Inc;
 
 class Deactivate{
    static function deactivate(){
        flush_rewrite_rules();
    }
 }