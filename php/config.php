<?php 
define('__ROOT__', $_SERVER["DOCUMENT_ROOT"] . "/assigment_scandiweb");
define('__BASE__', '/assigment_scandiweb');
class Config
{
    public static function getPageTPClass($pageName){
        return isset(self::$classes[$pageName]) ? self::$classes[$pageName] : null;
    }
    private static $classes = [
        'home' => Homepage::class,
        'addProduct' => AddProduct::class
    ];

}