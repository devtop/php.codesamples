<?php
namespace Standard\View;


class Viewmodel implements ViewmodelInterface
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var string
     */
    private $scriptname;

    /**
     * @param $key
     * @param $data
     */
    public function set($key, $data)
    {
        $this->data[$key] = $data;
    }

    /**
     * @param $key
     */
    public function get($key)
    {
        return $this->data[$key];
    }

    /**
     * @param string $scriptname
     */
    public function setScriptname($scriptname)
    {
        $this->scriptname = $scriptname;
    }

    /**
     * @return string
     */
    public function getScriptname()
    {
        return $this->scriptname;
    }
}