<?php
namespace Standard\View;


class Model implements ModelInterface
{
    private $data = [];

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
}