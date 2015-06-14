<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\View;

class RendererPhp implements RendererInterface
{
    /**
     * @var ViewModelInterface
     */
    private $view;

    /**
     * @var ViewscriptResolverInterface

     */
    private $viewscriptResolver;

    /**
     * @param ViewModelInterface $viewmodel
     * @param ViewscriptResolverInterface $resolver
     */
    public function __construct(ViewModelInterface $viewmodel, ViewscriptResolverInterface $resolver)
    {
        $this->setViewmodel($viewmodel);
        $this->setViewscriptResolver($resolver);
        return $this;
    }

    /**
     * @param ViewscriptResolverInterface $resolver
     */
    public function setViewscriptResolver(ViewscriptResolverInterface $resolver)
    {
        $this->viewscriptResolver = $resolver;
    }

    /**
     * @return ViewscriptResolverInterface
     */
    public function getViewscriptResolver()
    {
        return $this->viewscriptResolver;
    }

    /**
     * @param ViewModelInterface $view
     */
    public function setViewmodel(ViewModelInterface $view)
    {
        $this->view = $view;
    }

    /**
     * @return ViewModel
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return string
     */
    public function render()
    {
        ob_start();
        $this->doRender();
        return ob_get_clean();
    }

    /**
     * Includes a view template script to render it.
     */
    private function doRender()
    {
        include $this->viewscriptResolver->getScript($this->getScriptname());
    }

    /**
     * @return string
     */
    private function getScriptname()
    {
        return $this->view->getScriptname();
    }
}