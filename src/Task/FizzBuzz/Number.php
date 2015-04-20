<?php

namespace Task\FizzBuzz;

/**
 * Class Number
 * @package Task\FizzBuzz
 */
class Number
{
    /**
     * @var
     */
    private $number;

    /**
     * @param $number
     */
    public function __construct($number=null)
    {
        if (isset($number)) {
            $this->set($number);
        }
    }

    /**
     * @param $number
     */
    public function set($number)
    {
        $this->number = $number;
    }

    public function get()
    {
        return $this->number;
    }

}