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
        $this->assertSame($number, $subject->getNumber(), 'Did not get, what I set.');
    }

    /**
     * @param $number
     * @depends testSetAndGetNumber
     * @dataProvider dpGoodNumbers
     */
    public function testSetNumberThroughConstructor($number)
    {
        $subject = new Number($number);

        $this->assertSame($number, $subject->getNumber(), 'Did not get, what I set.');
    }

    /**
     * @return array
     */
    public function dpFizzNumbers()
    {
        return [
            [3], [6], [0], [9], [81], [-18]
        ];
    }

    /**
     * @param $number
     * @depends testSetNumberThroughConstructor
     * @dataProvider dpFizzNumbers
     */
    public function testDetectFizzNumbers($number)
    {
        $subject = new Number($number);

        $this->assertTrue($subject->isFizz(), 'That number should be a fizz');
    }
}