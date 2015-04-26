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

    /**
     * Checks if scriptname is valid and script exists
     * @param string $scriptname
     */
    public function isScript($scriptname)
    {
        if (!isset($this->templatemap[$scriptname])) {
            return false;
        }
        $file = $this->templatemap[$scriptname];
        if (!is_readable($file)){
            return false;
        }
        return true;
    }

    /**
     * @param $scriptname
     * @return string
     * @throws RuntimeException
     */
    public function getScript($scriptname)
    {
        if (!$this->isScript($scriptname)) {
            throw new RuntimeException('Scriptname '. $scriptname . ' is not valid.');
        }
        return $this->templatemap[$scriptname];
    }
}