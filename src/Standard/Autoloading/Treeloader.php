<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Autoloading;

require_once __DIR__.'/StaticRegisterInterface.php';

/**
 * Class Treeloader
 * @package Standard\Autoloading
 */
class Treeloader implements StaticRegisterInterface
{
    private $rootPath;

    /**
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @param array $options
     * @return Treeloader
     */
    public static function register(Array $options)
    {
        $instance = new static($options['rootPath']);
        $instance->doRegister();
        return $instance;
    }

    /**
     * @return bool
     */
    public function doRegister()
    {
        return spl_autoload_register([$this, 'loadclass']);
    }

    /**
     * @returns bool
     */
    public function unregister()
    {
        return spl_autoload_unregister([$this, 'loadClass']);
    }

    /**
     * @param $class
     * @return mixed
     */
    private function transformClassToFolderFormat($class)
    {
        return str_replace('\\', '/', $class);
    }

    /**
     * @param $class
     * @return string
     */
    private function classToPath($class)
    {
        return $this->rootPath . '/' . $this->transformClassToFolderformat($class) . '.php';
    }

    /**
     * @param $class
     */
    public function loadClass($class)
    {
        $file = $this->classToPath($class);
        if (file_exists($file)) {
            include $file;
        }
    }
}