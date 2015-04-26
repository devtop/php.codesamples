<?php

namespace Standard\View;


use Standard\View\TestUtility\StandardTemplatemapResolverFactory;

class RendererHttpTest extends \PHPUnit_Framework_TestCase
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
     *
     */
    public function testSetAndGetViewmodel()
    {
        $renderer = new RendererHttp();

        $viewmodel = new Viewmodel();
        $renderer->setView($viewmodel);
        $this->assertSame($viewmodel, $renderer->getView(), 'Renderer does not return viewmodel, that was set.');
    }

    /**
     *
     */
    public function testSetAndGetViewscriptResolver()
    {
        $renderer = new RendererHttp();
        $resolver = new TemplatemapResolver();

        $renderer->setViewscriptResolver($resolver);
        $this->assertSame($resolver, $renderer->getViewscriptResolver(), 'Renderer does not return ViewscriptResolver');
    }

    /**
     * @return array
     */
    public function dpPlainTextFileCandidates()
    {
        $testCases = [];

        $viewmodel = new Viewmodel();
        $viewmodel->setScriptname('test');
        $testCases[] = [$viewmodel, 'lorem ipsum dolor'];

        $viewmodel = new Viewmodel();
        $viewmodel->setScriptname('view/standard/layout');
        $testCases[] = [$viewmodel, 'layout'];

        return $testCases;
    }

    /**
     * @param string $scripname
     * @param $expectedResult
     * @dataProvider dpPlainTextFileCandidates
     * @depends testSetAndGetViewscriptResolver
     * @depends testSetAndGetViewmodel
     * depends TemplatemapResolverTest::testResolverProvidesPathtToIncludableScript
     * depends ViewmodelTest::testSetAndGetScriptname
     */
    public function testRenderReturnsContentOfPlainTextFile(Viewmodel $viewmodel, $expectedResult)
    {
        $renderer = new RendererHttp();
        $renderer->setViewscriptResolver($this->getStandardTemplatemapResolver());

        $renderer->setView($viewmodel);
        $this->assertSame($expectedResult, $renderer->render(), 'Result of rendering is not as excpected.');
    }

    /**
     * @return array
     */
    public function dpSimplePhpCandidates()
    {
        $testCases = [];

        $viewmodel = new Viewmodel();
        $viewmodel->setScriptname('first/echo');
        $testCases[] = [$viewmodel, 'Hello World!'];

        $viewmodel = new Viewmodel();
        $viewmodel->set('works', 'It works!');
        $viewmodel->setScriptname('mini/html');
        $testCases[] = [$viewmodel, '<html><body>It works!</body></html>'];

        return $testCases;
    }

    /**
     * @param string $scripname
     * @param $expectedResult
     * @dataProvider dpSimplePhpCandidates
     * @depends testRenderReturnsContentOfPlainTextFile
     */
    public function testRenderReturnsContentOfSimplePhpFile(Viewmodel $viewmodel, $expectedResult)
    {
        $renderer = new RendererHttp();
        $renderer->setViewscriptResolver($this->getStandardTemplatemapResolver());

        $renderer->setView($viewmodel);
        $this->assertSame($expectedResult, $renderer->render(), 'Result of rendering is not as excpected.');
    }

    private function getStandardTemplatemapResolver()
    {
        return self::$standardTemplatemapResolverFactory->createService();
    }
}