<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd03ceb865a7bc19b33c4cb61ae4967e5
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'KZ\\' => 3,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'KZ\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd03ceb865a7bc19b33c4cb61ae4967e5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd03ceb865a7bc19b33c4cb61ae4967e5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
