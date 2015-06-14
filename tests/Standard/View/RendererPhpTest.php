<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\View;

use Standard\View\TestUtility\StandardTemplatemapResolverFactory;

class RendererPhpTest extends \PHPUnit_Framework_TestCase
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
    public function testSetViewmodelCanBeSetByConstructor()
    {
        $viewmodel = new ViewModel();
        $renderer = new RendererPhp($viewmodel, $this->getStandardTemplatemapResolver());
        $this->assertSame($viewmodel, $renderer->getView(), 'Renderer does not return ViewModel set by constructor');
    }

    /**
     *
     */
    public function testSetAndGetViewmodel()
    {
        $renderer = new RendererPhp(new ViewModel(), $this->getStandardTemplatemapResolver());

        $viewmodel = new ViewModel();
        $renderer->setViewmodel($viewmodel);
        $this->assertSame($viewmodel, $renderer->getView(), 'Renderer does not return viewmodel, that was set.');
    }

    /**
     *
     */
    public function testSetViewscriptResolverByConstructor()
    {
        $viewscriptResolver = $this->getStandardTemplatemapResolver();

        $renderer = new RendererPhp(new ViewModel(), $viewscriptResolver);
        $this->assertSame(
            $viewscriptResolver,
            $renderer->getViewscriptResolver(),
            'Renderer does not return viewscriptResolver set by constructor'
        );
    }

    /**
     *
     */
    public function testSetAndGetViewscriptResolver()
    {
        $renderer = new RendererPhp(new ViewModel(), $this->getStandardTemplatemapResolver());
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

        $viewmodel = new ViewModel();
        $viewmodel->setScriptname('test');
        $testCases[] = [$viewmodel, 'lorem ipsum dolor'];

        $viewmodel = new ViewModel();
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
    public function testRenderReturnsContentOfPlainTextFile(ViewModel $viewmodel, $expectedResult)
    {
        $renderer = $this->getStandardRenderer();

        $renderer->setViewmodel($viewmodel);
        $this->assertSame($expectedResult, $renderer->render(), 'Result of rendering is not as excpected.');
    }

    /**
     * @return array
     */
    public function dpSimplePhpCandidates()
    {
        $testCases = [];

        $viewmodel = new ViewModel();
        $viewmodel->setScriptname('first/echo');
        $testCases[] = [$viewmodel, 'Hello World!'];

        $viewmodel = new ViewModel();
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
    public function testRenderReturnsContentOfSimplePhpFile(ViewModel $viewmodel, $expectedResult)
    {
        $renderer = $this->getStandardRenderer();

        $renderer->setViewmodel($viewmodel);
        $this->assertSame($expectedResult, $renderer->render(), 'Result of rendering is not as excpected.');
    }

    /**
     * @return TemplatemapResolver
     */
    private function getStandardTemplatemapResolver()
    {
        return self::$standardTemplatemapResolverFactory->createService();
    }

    /**
     * @return RendererPhp
     */
    private function getStandardRenderer()
    {
        $renderer = new RendererPhp(new ViewModel(), $this->getStandardTemplatemapResolver());
        $renderer->setViewscriptResolver($this->getStandardTemplatemapResolver());
        return $renderer;
    }

}