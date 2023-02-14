<?php
/**
 *  @package BookRegistration
 */

 class BookRegDectivate{
    static function deactivate(){
        flush_rewrite_rules();
    }
 }