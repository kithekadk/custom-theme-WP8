<?php
/**
 *  @package BookRegistrationWithcomposer
 */

 namespace Inc;

 class Otherfile{
    static function errortrigger(){
        // echo 'This triggers an error';
        flush_rewrite_rules();
    }
 }