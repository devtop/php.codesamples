<?php
namespace Standard\View;


/**
 * Class RendererPhp
 * @package Standard\View
 */
class RendererPhp implements Renderer
{
    /**
     * @var ViewmodelInterface
     */
    private $view;

    /**
     * @var ViewmodelInterface
     */
    private $layout;

    /**
     * @var ViewscriptResolverInterface

     */
    private $viewscriptResolver;

    /**
     * @param ViewmodelInterface $viewmodel
     */
    public function __construct(ViewmodelInterface $viewmodel, ViewscriptResolverInterface $resolver)
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
     * @param ViewmodelInterface $view
     */
    public function setViewmodel(ViewmodelInterface $view)
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
        include $this->viewscriptResolver->getScript($this->getScriptname());
    }

    /**
     * @return mixed
     */
    private function getScriptname()
    {
        return $this->view->getScriptname();
    }
}