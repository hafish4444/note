<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3641398b57639df1f7f94e94b964b4c6
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Klein\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Klein\\' => 
        array (
            0 => __DIR__ . '/..' . '/klein/klein/src/Klein',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3641398b57639df1f7f94e94b964b4c6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3641398b57639df1f7f94e94b964b4c6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
