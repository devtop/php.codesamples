<?php
namespace Standard\Autoloading;


interface StaticRegisterInterface
{
    public static function register(Array $options);
    public function unregister();

}