<?php
/**
 *  @package BookRegistrationWithcomposer
 */

 namespace Inc;

 class Activate{
    static function activate(){
        // BookReg::create_table_to_db();
        flush_rewrite_rules();
    }
 }