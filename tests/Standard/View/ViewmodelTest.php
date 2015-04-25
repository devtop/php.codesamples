<?php

namespace Standard\View;


class ViewmodelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function dpModelData()
    {
        return [
            ['key', 'data'],
            ['foo', [1,2,3]]
        ];
    }

    /**
     * @param $key
     * @param $data
     * @dataProvider dpModelData
     */
    public function testWriteAndReadData($key, $data)
    {
        $testModel = new Viewmodel();
        $testModel->set($key, $data);

        $this->assertSame($data, $testModel->get($key), 'Viewmodel does not return inserted structure.');
    }

}