<?php

namespace Standard\View;


class RendererHttpTest extends \PHPUnit_Framework_TestCase
{
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


}