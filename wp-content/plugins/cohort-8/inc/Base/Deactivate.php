<?php
/**
 *  @package Cohort8
 */

 namespace C8\Base;

 class Deactivate{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}