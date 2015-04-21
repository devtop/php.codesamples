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

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Fizz Detection
     * @return bool
     */
    public function isFizz()
    {
        return ($this->number % 3 === 0);
    }

    /**
     * BuzzDetection
     * @return bool
     */
    public function isBuzz()
    {
        return ($this->number % 5 == 0);
    }
}