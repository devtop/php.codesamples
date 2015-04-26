<?php
namespace Standard\View;


class TemplatemapResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function dpProperMaps()
    {
        return [
            [['test' => __DIR__.'/data/test.phtml']],
            [['test' => __DIR__.'/data/test.phtml', 'view/standard/layout' => __DIR__.'/data/layout.phtml']],
            [[]],
        ];
    }

    /**
     * @param array $templatemap
     * @dataProvider dpProperMaps
     */
    public function testSetAndGetTemplatemap(array $templatemap)
    {
        $resolver = new TemplatemapResolver();
        $resolver->setTemplatemap($templatemap);

        $this->assertSame($templatemap, $resolver->getTemplatemap(), 'Resolver does not return, what was set.');
    }


}
