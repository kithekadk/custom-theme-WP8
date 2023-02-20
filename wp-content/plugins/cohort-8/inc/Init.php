<?php
/**
 *  @package Cohort8
 */

namespace C8;

class Init{
    public static function get_services(){
        return [
            Pages\Admin::class,
            Base\SettingsLinks::class,
            Base\Enqueue::class,
            Base\C8Assessments::class
        ];
    }


    public static function register_services(){
        foreach (self::get_services() as $class){
            $service = self::instantiate($class);
            if (method_exists($service, 'register')){
                $service->register();
            }
        }
    }

    private static function instantiate($class){
        $service = new $class();
        return $service;
    }
}