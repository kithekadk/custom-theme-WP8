<?php
/**
 *  @package BookRegistration
 */

 class BookRegActivate{
    static function activate(){
        BookReg::create_table_to_db();
        flush_rewrite_rules();
    }
 }