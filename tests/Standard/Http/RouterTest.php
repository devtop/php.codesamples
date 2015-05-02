<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Http;


use Standard\Http\Router\MapResolver;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Router
     */
    private $router;

    public function setUp()
    {
        $this->router = new Router();
        parent::setUp();
    }

    /**
     *
     */
    public function testAddResolver()
    {
        $router = $this->router;
        $router->addResolver($this->createResolverMock());
    }

    /**
     * @depends testAddResolver
     */
    public function testAddResolverReturnsId()
    {
        $router = $this->router;
        $id = $router->addResolver($this->createResolverMock());
        $this->assertNotNull($id, 'Router does not return a valid ID.');
    }

    /**
     * @depends testAddResolverReturnsId
     */
    public function testAddResolverReturnsIndividualIds()
    {
        $router = $this->router;
        $firstId = $router->addResolver($this->createResolverMock());
        $secondId = $router->addResolver($this->createResolverMock());
        $this->assertNotEquals($firstId, $secondId, 'Router does not return individual IDs.');
    }

    /**
     * @depends testAddResolverReturnsIndividualIds
     */
    public function testGetResolverById()
    {
        $router = $this->router;
        $resolver = $this->createResolverMock();
        $id = $router->addResolver($resolver);
        $this->assertSame($resolver, $router->getResolver($id), 'Router does not return injected resolver.');
    }

    /**
     * @return MapResolver
     */
    private function createResolverMock()
    {
        return new MapResolver();
    }
}
