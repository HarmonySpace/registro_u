<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0e92d79d618edff2a59857b5d2331073
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Regis01\\Unan01\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Regis01\\Unan01\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Mustache' => 
            array (
                0 => __DIR__ . '/..' . '/mustache/mustache/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0e92d79d618edff2a59857b5d2331073::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0e92d79d618edff2a59857b5d2331073::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit0e92d79d618edff2a59857b5d2331073::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit0e92d79d618edff2a59857b5d2331073::$classMap;

        }, null, ClassLoader::class);
    }
}
