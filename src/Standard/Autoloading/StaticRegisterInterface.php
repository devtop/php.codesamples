<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Autoloading;

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