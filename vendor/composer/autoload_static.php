<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9cc9c48f7e23ea7c671a4b5d5490e73b
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Install\\' => 8,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Install\\' => 
        array (
            0 => __DIR__ . '/../..' . '/install',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/php',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9cc9c48f7e23ea7c671a4b5d5490e73b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9cc9c48f7e23ea7c671a4b5d5490e73b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9cc9c48f7e23ea7c671a4b5d5490e73b::$classMap;

        }, null, ClassLoader::class);
    }
}
