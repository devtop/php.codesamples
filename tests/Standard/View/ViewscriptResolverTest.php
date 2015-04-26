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
            [$this->getStandardTemplatemap()],
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

    /**
     * @return array
     */
    public function dpExistingScriptnames()
    {
        return [
            ['test'],
            ['view/standard/layout'],
        ];
    }



    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpExistingScriptnames
     */
    public function testResolverIdentifiesValidScripts($scriptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();

        $this->assertTrue($resolver->isScript($scriptname), 'Script should be identified as valid.');
    }

    /**
     * @return array
     */
    public function dpInvalidScriptnames()
    {
        return [
            ['Katzenjammer'],
            ['ober/muffel/test'],
        ];
    }

    /**
     * @param string $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpInvalidScriptnames
     */
    public function testResolverIdentifiesInvalidScripts($scriptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();
        $this->assertFalse($resolver->isScript($scriptname), 'Scriptname should be identified as invalid');
    }

    /**
     * @return array
     */
    public function dpNotExistingScriptFile()
    {
        return [
            ['file/not/exists'],
        ];
    }

    /**
     * @param $scriptname
     * @depends testSetAndGetTemplatemap
     * @dataProvider dpNotExistingScriptFile
     */
    public function testResolverIdentifiesNotExistingScripts($scriptname)
    {
        $resolver = $this->getStandardTemplatemapResolver();
        $this->assertFalse($resolver->isScript($scriptname), 'Scriptfile should be identified as not existing.');
    }

    /**
     * @return array
     */
    private function getStandardTemplatemap()
    {
        return [
            'test' => __DIR__.'/data/test.phtml',
            'view/standard/layout' => __DIR__.'/data/layout.phtml',
            'file/not/exists' => __DIR__.'/data/filenotexists.phtml',
        ];
    }

    /**
     * @return TemplatemapResolver
     */
    private function getStandardTemplatemapResolver()
    {
        $resolver = new TemplatemapResolver();
        $resolver->setTemplatemap($this->getStandardTemplatemap());
        return $resolver;
    }
}
