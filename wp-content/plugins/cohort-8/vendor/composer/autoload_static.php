<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb409bf04637841d7e16a6764e150c272
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'C8\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'C8\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb409bf04637841d7e16a6764e150c272::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb409bf04637841d7e16a6764e150c272::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb409bf04637841d7e16a6764e150c272::$classMap;

        }, null, ClassLoader::class);
    }
}
