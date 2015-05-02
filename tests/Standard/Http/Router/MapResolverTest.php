<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Http\Router;


class MapResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapResolver
     */
    private $resolver;

    public function setUp()
    {
        $this->resolver = new MapResolver();
    }

    /**
     *
     */
    public function testMapCanBeSet()
    {
        $resolver = $this->resolver;
        $resolver->setMap($this->getCustomTestMap());
    }

    /**
     * @depends testMapCanBeSet
     */
    public function testGetMap()
    {
        $resolver = $this->resolver;
        $map = $this->getCustomTestMap();
        $resolver->setMap($map);
        $this->assertSame($map, $resolver->getMap(), 'Resolver does not retrun same map that was set.');
    }

    public function testInjectUrlIntoResolveUrl()
    {
        $resolver = $this->resolver;
        $resolver->resolveUrl('url');
    }

    public function dpUnknownUrls()
    {
        return [
            ['/this'],
            ['/that'],
        ];
    }

    /**
     * @param string $unknowUrl
     * @dataProvider dpUnknownUrls
     * @debends testInjectUrlIntoResolveUrl
     */
    public function testUrlResolvesNullForUnknowUrl($unknownUrl)
    {
        $resolver = $this->resolver;
        $this->assertNull($resolver->resolveUrl($unknownUrl, 'Resolver resolves unknown URL.'));
    }

    /**
     * @return array
     */
    public function dpKnownUrls()
    {
        $customMap = $this->getCustomTestMap();
        $mapper = function ($routeId, $routeUrl) {
            return [$routeUrl, $routeId];
        };
        return array_map($mapper, array_keys($customMap), array_values($customMap));
    }

    /**
     * @param $url
     * @param $expect
     * @dpends testUrlResolvesNullForUnknowUrl
     * @dataProvider dpKnownUrls
     */
    public function testUrlResolverResolvesKnownUrl($url, $expect)
    {
        $resolver = $this->resolver;
        $resolver->setMap($this->getCustomTestMap());
        $this->assertSame($expect, $resolver->resolveUrl($url), 'Resolver does not resolve Url correctly.');
    }

    /**
     * @param $url
     * @param $expect
     * @dpends testUrlResolverResolvesKnownUrl
     * @dataProvider dpKnownUrls
     */
    public function testUrlCanBePostpendedWithAnything($url, $expect)
    {
        $resolver = $this->resolver;
        $resolver->setMap($this->getCustomTestMap());
        $url .= '/some/stuff';
        $this->assertSame($expect, $resolver->resolveUrl($url), 'Resolver is irritated by postpended stuff.');
    }

    /**
     * @return array
     */
    private function getCustomTestMap()
    {
        return [
            'test1' => '/test/layout'
        ];
    }
}
