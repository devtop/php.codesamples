<?php
namespace Standard\View;


class RendererHttp implements Renderer
{
    /**
     * @var
     */
    private $view;

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
}