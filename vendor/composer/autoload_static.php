<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9036e3cb9307e8457c0881205f79da4
{
    public static $fallbackDirsPsr0 = array (
        0 => __DIR__ . '/../..' . '/src/Hudutech',
    );

    public static $classMap = array (
        'App\\Controller\\Registration\\TeacherController' => __DIR__ . '/../..' . '/src/Hudutech/Controller/TeacherController.php',
        'Hudutech\\AppInterface\\StudentInterface' => __DIR__ . '/../..' . '/src/Hudutech/AppInterface/StudentInterface.php',
        'Hudutech\\AppInterface\\TeacherInterface' => __DIR__ . '/../..' . '/src/Hudutech/AppInterface/TeacherInterface.php',
        'Hudutech\\Controller\\StudentController' => __DIR__ . '/../..' . '/src/Hudutech/Controller/StudentController.php',
        'Hudutech\\DBManager\\DB' => __DIR__ . '/../..' . '/src/Hudutech/DBManager/DB.php',
        'Hudutech\\Entity\\Student' => __DIR__ . '/../..' . '/src/Hudutech/Entity/Student.php',
        'Hudutech\\Entity\\StudentClass' => __DIR__ . '/../..' . '/src/Hudutech/Entity/StudentClass.php',
        'Hudutech\\Entity\\Subject' => __DIR__ . '/../..' . '/src/Hudutech/Entity/Subject.php',
        'Hudutech\\Entity\\Teacher' => __DIR__ . '/../..' . '/src/Hudutech/Entity/Teacher.php',
        'Hudutech\\Entity\\User' => __DIR__ . '/../..' . '/src/Hudutech/Entity/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr0 = ComposerStaticInitd9036e3cb9307e8457c0881205f79da4::$fallbackDirsPsr0;
            $loader->classMap = ComposerStaticInitd9036e3cb9307e8457c0881205f79da4::$classMap;

        }, null, ClassLoader::class);
    }
}
