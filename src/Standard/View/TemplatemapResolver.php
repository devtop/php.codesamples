<?php
namespace Standard\View;


class TemplatemapResolver implements ViewscriptResolverInterface
{
    /**
     * @var array
     */
    private $templatemap = array();

    /**
     * @param array $scriptMap
     */
    public function setTemplatemap(array $templatemap)
    {
        $this->templatemap = $templatemap;
    }

    /**
     * @return array
     */
    public function getTemplatemap()
    {
        return $this->templatemap;
    }
}