<?php

namespace Standard\View;


class RendererHttpTest extends \PHPUnit_Framework_TestCase
{
    public function testSetAndGetViewmodel()
    {
        $renderer = new RendererHttp();

        $viewmodel = new Model();
        $renderer->setView($viewmodel);
        $this->assertSame($viewmodel, $renderer->getView());
    }

}