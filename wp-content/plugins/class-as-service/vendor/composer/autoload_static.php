<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc10c67acf399881e7f39bc707be2aabe
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Inc\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc10c67acf399881e7f39bc707be2aabe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc10c67acf399881e7f39bc707be2aabe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc10c67acf399881e7f39bc707be2aabe::$classMap;

        }, null, ClassLoader::class);
    }
}
