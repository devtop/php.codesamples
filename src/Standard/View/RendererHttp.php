<?php
namespace Standard\View;


class RendererHttp implements Renderer
{
    /**
     * @var ViewmodelInterface
     */
    private $view;

    /**
     * @var ViewscriptResolverInterface

     */
    private $viewscriptResolver;

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
     * @param ViewmodelInterface $view
     */
    public function setView(ViewmodelInterface $view)
    {
        $this->view = $view;
    }

    /**
     * @return Viewmodel
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
        return ob_get_clean();;
    }

    /**
     *
     */
    private function doRender()
    {
        include $this->viewscriptResolver->getScript($this->view->getScriptname());
    }
}