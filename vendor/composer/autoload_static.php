<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit91aedf36ccfb37971486f2f5729f2798
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Dean\\Pd\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Dean\\Pd\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit91aedf36ccfb37971486f2f5729f2798::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit91aedf36ccfb37971486f2f5729f2798::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit91aedf36ccfb37971486f2f5729f2798::$classMap;

        }, null, ClassLoader::class);
    }
}