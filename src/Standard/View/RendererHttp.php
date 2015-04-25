<?php
namespace Standard\View;


class RendererHttp implements Renderer
{
    /**
     * @var
     */
    private $view;

    /**
     * @param ModelInterface $view
     */
    public function setView(ModelInterface $view)
    {
        $this->view = $view;
    }

    /**
     * @return Model
     */
    public function getView()
    {

        return $this->view;
    }
}