<?php
/**
 *  @package Cohort8
 */

namespace C8\Base;

class Activate{
    public static function activate(){
        flush_rewrite_rules();
    }
}