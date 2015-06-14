<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Time;


class StopwatchTest extends \PHPUnit_Framework_TestCase
{
    public function testGetElapsedTimeIsCallable()
    {
        $stopwatch = new Stopwatch();
        $stopwatch->getElapsedTime();
    }

    /**
     * @depends testGetElapsedTimeIsCallable
     */
    public function testGetElapsedTimeProvidesFloat()
    {
        $stopwatch = new Stopwatch();
        $this->assertTrue(is_float($stopwatch->getElapsedTime()));
    }

    /**
     * @depends testGetElapsedTimeIsCallable
     */
    public function testElapsedTimeIsNearlyZero()
    {
        $stopwatch = new Stopwatch();
        $this->assertLessThan(0.005, $stopwatch->getElapsedTime());
    }

    /**
     * @depends testGetElapsedTimeIsCallable
     */
    public function testElapsedTimeIsGreaterThanSleep()
    {
        $stopwatch = new Stopwatch();
        usleep(5000);
        $this->assertGreaterThanOrEqual(0.005, $stopwatch->getElapsedTime());
    }

    public function testIsConvertableToString()
    {
        $stopwatch = new Stopwatch();
        (string)$stopwatch;
    }

    /**
     * @depends testIsConvertableToString
     */
    public function testProvidesMicrosecondFormedOutput()
    {
        $stopwatch = new Stopwatch();
        $this->assertStringMatchesFormat('%d.%d ms', (string)$stopwatch);
    }

    /**
     * @depends testProvidesMicrosecondFormedOutput
     */
    public function testStringIsLow()
    {
        $stopwatch = new Stopwatch();
        $stopwatch = (string)$stopwatch;
        $match = '^[01]([.,][\d]{0,3}) ms$';
        $founds = preg_match("/$match/", $stopwatch);
        $this->assertSame(1, $founds, "$stopwatch should match $match");
    }



    /**
     * @depends testStringIsLow
     */
    public function testStringGrows()
    {
        $stopwatch = new Stopwatch();
        usleep(10000);
        $founds = preg_match('/^\d{2,} ms$/', (string)$stopwatch);
        $this->assertSame(1, $founds, 'String output does not grow.');
    }
}