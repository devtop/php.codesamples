<?php
namespace Standard\Autoloading;

/**
 * Interface StaticRegisterInterface
 * @package Standard\Autoloading
 */
interface StaticRegisterInterface
{
    /**
     * @param array $options
     * @return mixed
     */
    public static function register(Array $options);

    /**
     * @return mixed
     */
    public function unregister();
}