<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\View;

use Standard\View\TestUtility\StandardTemplatemapResolverFactory;

class TemplatemapResolverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var StandardTemplatemapResolverFactory
     */
    private static $standardTemplatemapResolverFactory;

    public static function setUpBeforeClass()
    {
        self::$standardTemplatemapResolverFactory = new StandardTemplatemapResolverFactory();
        parent::setUpBeforeClass();
    }

    /**
     * @return array
     */
    public function dpProperMaps()
    {
        return [
            [['test' => __DIR__.'/data/test.phtml']],
            [StandardTemplatemapResolverFactory::getStandardTemplatemap()],
            [[]],
        ];
    }

    /**
     * @param array $templatemap
     * @dataProvider dpProperMaps
     */
    public function testSetAndGetTemplatemap(array $templatemap)
    {
        $resolver = new TemplatemapResolver();
        $resolver->setTemplatemap($templatemap);

        $this->assertSame($templatemap, $resolver->getTemplatemap(), 'Resolver does not return, what was set.');
    }

    /**
     * @return array
     */
    public function dpExistingScriptnames()
    {
        return [
            ['test'],
            ['view/standard/layout'],
        ];
    }

    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpExistingScriptnames
     */
    public function testResolverIdentifiesValidScripts($scriptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();

        $this->assertTrue($resolver->isScript($scriptname), 'Script should be identified as valid.');
    }

    /**
     * @return array
     */
    public function dpInvalidScriptnames()
    {
        return [
            ['Katzenjammer'],
            ['ober/muffel/test'],
        ];
    }

    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpInvalidScriptnames
     */
    public function testResolverIdentifiesInvalidScripts($scriptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();
        $this->assertFalse($resolver->isScript($scriptname), 'Scriptname should be identified as invalid');
    }

    /**
     * @return array
     */
    public function dpNotExistingScriptFile()
    {
        return [
            ['file/not/exists'],
        ];
    }

    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpNotExistingScriptFile
     */
    public function testResolverIdentifiesNotExistingScripts($scriptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();
        $this->assertFalse($resolver->isScript($scriptname), 'Scriptfile should be identified as not existing.');
    }

    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpExistingScriptnames
     */
    public function testResolverProvidesPathtToIncludableScript($scriptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();
        $file = $resolver->getScript($scriptname);
        $this->assertFileExists($file, "Script $file should exist");
    }

    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpInvalidScriptnames
     * @expectedException RuntimeException
     */
    public function testExceptionThrowWhenResolvingNotExistingScriptnameEntry($sciptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();
        $resolver->getScript($sciptname);
    }

    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpNotExistingScriptFile
     * @expectedException RuntimeException
     */
    public function testExceptionThrowWhenResolvingNotExistingScriptFile($sciptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();
        $resolver->getScript($sciptname);
    }

    /**
     * @return TemplatemapResolver
     */
    private function getStandardTemplatemapResolver()
    {
        return self::$standardTemplatemapResolverFactory->createService();
    }
}
