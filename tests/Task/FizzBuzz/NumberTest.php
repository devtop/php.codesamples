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
            [0], [1], [-1], [15], [-15], [100], [1000], [1001], [71]
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
     * Provides Fizz numbers
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

        $this->assertTrue($subject->isFizz(), 'That number should be a Fizz');
    }

    /**
     * Provides Buzz numbers
     * @return array
     */
    public function dpBuzzNumbers()
    {
        return [
            [0], [5], [-5], [50], [15]
        ];
    }

    /**
     * @param $number
     * @dataProvider dpBuzzNumbers
     * @depends testSetNumberThroughConstructor
     */
    public function testDetectBuzzNumbers($number)
    {
        $subject = new Number($number);

        $this->assertTrue($subject->isBuzz());
    }

    /**
     * @return array
     */
    public function dpNumbersAndFizzAndBuzzAndFizzBuzz()
    {
        return [
            [1, 1],
            [2, 2],
            [3, 'Fizz'],
            [4, 4],
            [5, 'Buzz'],
            [15, 'FizzBuzz'],
            [0, 'FizzBuzz'],
            [-1, -1],
            [-3, 'Fizz'],
            [-5, 'Buzz'],
            [-15, 'FizzBuzz']
        ];
    }

    /**
     * @param $number
     * @param $expect
     * @dataProvider dpNumbersAndFizzAndBuzzAndFizzBuzz
     * @depends testSetNumberThroughConstructor
     */
    public function testFizzBuzzSubstitution($number, $expect)
    {
        $subject = new Number($number);

        $this->assertSame($expect, $subject->get(), 'Substitution does not work.');
    }

    /**
     * @param $number
     * @param $expect
     * @dataProvider dpNumbersAndFizzAndBuzzAndFizzBuzz
     * @depends testFizzBuzzSubstitution
     */
    public function testFizzBuzzSubstitutionThroughCall($number, $expect)
    {
        $subject = new Number($number);

        $this->assertSame($expect, $subject(), 'Substitution through call does not work.');
    }
}