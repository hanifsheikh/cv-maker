<?php

// Show Development Errors
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('allow_url_fopen', 'On');
date_default_timezone_set("Asia/Dhaka");

if (!extension_loaded('gd')) {
    return die("<h2>PHP GD extension is required!</h2> <p> GD is not found on your PHP installation. enable extension from 'php.ini'. </p>");
}
if (!extension_loaded('imagick')) {
    return die("<h2>PHP Imagick extension is required!</h2> <p> Imagick is not found on your PHP installation. enable extension from 'php.ini'. </p> 
    <p>For Windows : Read this thread <a href='https://ourcodeworld.com/articles/read/349/how-to-install-and-enable-the-imagick-extension-in-xampp-for-windows' target='_blank'>https://ourcodeworld.com/articles/read/349/how-to-install-and-enable-the-imagick-extension-in-xampp-for-windows</a></p>
    <p>For Debian/Ubuntu : Read this thread <a href='https://linux.how2shout.com/how-to-install-php-imagemagick-on-ubuntu-22-04/' target='_blank'>https://linux.how2shout.com/how-to-install-php-imagemagick-on-ubuntu-22-04/</a></p>
    ");
}


// App configs, helper functions and router.
require 'app.php';
require 'helpers.php';
require 'router.php';

//  Load Dompdf Fonts 
exec('php ' . str_replace(' ', '\ ', __DIR__) . '/load_fonts.php');

// Create symling in public directory for storage folder
if (!file_exists(__DIR__ . '/../public/storage')) {
    switch (PHP_OS) {
        case 'WINNT':
            exec('mklink /J "' . __DIR__ . '\..\public\storage" ' .  '"' . __DIR__ . '\..\storage"');
            break;
        default:
            exec('ln -s "' . __DIR__ . '/../storage" ' . '"' . __DIR__ . '/../public/storage"');
            break;
    }
}
