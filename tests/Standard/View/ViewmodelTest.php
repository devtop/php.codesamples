<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
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

    /**
     * @return array
     */
    public function dpProperScriptnames()
    {
        return [
            ['tasks/fizzbuzz'],
            ['test/test'],
        ];
    }

    /**
     * @param $scriptname
     * @dataProvider dpProperScriptnames
     */
    public function testSetAndGetScriptname($scriptname)
    {
        $viewmodel = new Viewmodel();

        $viewmodel->setScriptname($scriptname);
        $this->assertSame($scriptname, $viewmodel->getScriptname(), 'Viewmodel does not return inserted scrriptname.');
    }
}