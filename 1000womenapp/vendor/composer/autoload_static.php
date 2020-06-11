<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit119b24f66055fa808c2b3a31ceeccfda
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Config' => __DIR__ . '/../..' . '/classes/config.php',
        'PHPMailer\\PHPMailer\\Exception' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/Exception.php',
        'PHPMailer\\PHPMailer\\OAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/OAuth.php',
        'PHPMailer\\PHPMailer\\PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/PHPMailer.php',
        'PHPMailer\\PHPMailer\\POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/POP3.php',
        'PHPMailer\\PHPMailer\\SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/src/SMTP.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit119b24f66055fa808c2b3a31ceeccfda::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit119b24f66055fa808c2b3a31ceeccfda::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit119b24f66055fa808c2b3a31ceeccfda::$classMap;

        }, null, ClassLoader::class);
    }
}
