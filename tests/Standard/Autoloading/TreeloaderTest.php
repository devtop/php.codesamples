<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Autoloading;

class TreeloaderTest extends \PHPUnit_Framework_TestCase
{
    const CANDIDATE_CLASSNAME = 'Standard\Autoloading\Treeloader';
    const CLASS_DIR = '/data';

    /**
     * Provides the folder with dummy classes for testing
     * @return string
     */
    private function getClassDir()
    {
        return __DIR__ . self::CLASS_DIR;
    }

    /**
     * Treeloader Class exists
     */
    public function testTreeloaderClassExists()
    {
        $this->assertTrue(class_exists(self::CANDIDATE_CLASSNAME), 'Class doesn\'t exist');
    }

    /**
     * Static registering returns instance
     * @depends testTreeloaderClassExists
     */
    public function testStaticRegisterReturnsInstance()
    {
        $this->assertInstanceOf(
            self::CANDIDATE_CLASSNAME,
            $instance = \Standard\Autoloading\Treeloader::register(['rootPath' => $this->getClassDir()])
        );
        $instance->unregister();
    }

    /**
     * @return array
     */
    public function dpTestClasses()
    {
        return [
            ['TreeloaderTestClasses\Class1'],
            ['TreeloaderTestClasses\Class2']
        ];
    }

    /**
     * Classes aren't loadable without Treeloader
     * @dataProvider dpTestClasses
     * @param string $classname
     */
    public function testClassesAreAbsend($classname)
    {
        $this->assertFalse(class_exists($classname), $classname.' shall not exist yet.');
    }

    /**
     * Classes can be loaded
     * @depends testClassesAreAbsend
     * @dataProvider dpTestClasses
     */
    public function testClassesCanBeLoaded($classname)
    {
        $instance = \Standard\Autoloading\Treeloader::register(['rootPath' => $this->getClassDir()]);
        $this->assertTrue(class_exists($classname), $classname.' shall exist now but seems absend.');
        $instance->unregister();
    }

    /**
     * @return array
     */
    public function dpTestClassesNotLoaded()
    {
        return [
            ['TreeloaderTestClasses\ClassUnregister']
        ];
    }

    /**
     * Switching register, unregister, register works
     * @depends testClassesAreAbsend
     * @dataProvider dpTestClassesNotLoaded
     * @param string $classname
     */
    public function testSwitchingRegisterUnregisterRegister($classname)
    {
        $instance = \Standard\Autoloading\Treeloader::register(['rootPath' => $this->getClassDir()]);
        $instance->unregister();
        $this->assertFalse(class_exists($classname), $classname.' shall not exist.');

        $instance->doRegister();
        $this->assertTrue(class_exists($classname), $classname.' shall exist now but seems absend.');
    }
}