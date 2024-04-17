<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit581dcd3322d1d9e11551ff98a235570a
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'DROIT_ELEMENTOR_TEMPLATE\\Core\\' => 30,
            'DROIT_ELEMENTOR_TEMPLATE\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'DROIT_ELEMENTOR_TEMPLATE\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'DROIT_ELEMENTOR_TEMPLATE\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit581dcd3322d1d9e11551ff98a235570a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit581dcd3322d1d9e11551ff98a235570a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
