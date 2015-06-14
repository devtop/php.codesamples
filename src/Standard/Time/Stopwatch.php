<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Time;

class Stopwatch
{
    private $startMicrotime;

    public function __construct()
    {
        $this->start();
    }

    /**
     * @return Float
     */
    public function getElapsedTime()
    {
        return microtime(true) - $this->startMicrotime;
    }

    private function start()
    {
        $this->startMicrotime = microtime(true);
    }

    public function __toString()
    {
        $elapsed = $this->getElapsedTime();
        $format = $this->getFormatString($elapsed);
        $elapsed *= $this->getScale($elapsed);

        return sprintf($format, $elapsed);
    }

    /**
     * @param float $number
     * @return string
     */
    private function getFormatString($number)
    {
        if ($number>=10) {
            $formatString = '%d seconds';
        }
        elseif ($number>1) {
            $formatString = '%01.2F s';
        }
        elseif ($number<0.010){
            $formatString = '%01.3F ms';
        }
        else {
            $formatString = '%d ms';
        }

        return $formatString;
    }

    private function getScale($number)
    {
        if ($number<1) {
            return 1000;
        }
        return 1;
    }
}