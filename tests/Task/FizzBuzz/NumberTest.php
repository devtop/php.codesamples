<?php

namespace Task\FizzBuzz;

/**
 * Class NumberTest
 * @package Task\FizzBuzz
 */
class NumberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function dpGoodNumbers()
    {
        return [
            [0], [1], [-1], [1000], [71]
        ];
    }

    /**
     * @param $number
     * @dataProvider dpGoodNumbers
     */
    public function testSetAndGetNumber($number)
    {
        $subject = new Number();

        $subject->set($number);
        $this->assertSame($number, $subject->get(), 'Did not get, what I set.');
    }

    /**
     * @param $number
     * @depends testSetAndGetNumber
     * @dataProvider dpGoodNumbers
     */
    public function testSetNumberThroughConstruct($number)
    {
        $subject = new Number($number);

        $this->assertSame($number, $subject->get(), 'Did not get, what I set.');
    }

}