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

    public function testStrictModeCanBeSet()
    {
        $resover = $this->resolver;
        $resover->setOptionStrict(true);
        $resover->setOptionStrict(false);
    }

    public function testStrictModeCanBeGet()
    {
        $resolver = $this->resolver;
        $resolver->getOptionStrict();
    }

    public function testStrictModeIsDefaultOff()
    {
        $resolver = $this->resolver;
        $this->assertFalse($resolver->getOptionStrict(), 'Strict mode is not off as default.');
    }

    /**
     * @return array
     */
    public function dpSomeStrictModes()
    {
        return [
            [true, true],
            [false, false],
            [0, false],
            [1, true],
        ];
    }

    /**
     * @param bool $mode
     * @dataProvider dpSomeStrictModes
     * @depends testStrictModeCanBeSet
     */
    public function testSetAndGetStrictMode($mode, $expect)
    {
        $resolver = $this->resolver;
        $resolver->setOptionStrict($mode);
        $this->assertSame($expect, $resolver->getOptionStrict(), 'Resolver does not return set strict mode.');
    }

    /**
     * @return array
     */
    public function dpPostpendedUrls()
    {
        $customMap = $this->getCustomTestMap();
        $mapper = function ($routeId, $routeUrl) {
            return [$routeUrl.'/some/pospended/stuff', $routeId];
        };
        return array_map($mapper, array_keys($customMap), array_values($customMap));
    }

    /**
     * @param $url
     * @param $expect
     * @dpends testUrlResolverResolvesKnownUrl
     * @dpends testStrictModeIsDefaultOff
     * @dataProvider dpPostpendedUrls
     */
    public function testUrlCanBePostpendedWithAnything($url, $expect)
    {
        $resolver = $this->resolver;
        $resolver->setMap($this->getCustomTestMap());
        $this->assertSame($expect, $resolver->resolveUrl($url), 'Resolver is irritated by postpended stuff.');
    }

    /**
     * @return array
     */
    public function dpWrongPostpendedUrls()
    {
        $customMap = $this->getCustomTestMap();
        $mapper = function ($routeUrl) {
            return [$routeUrl.'some/pospended/stuff'];
        };
        return array_map($mapper, array_values($customMap));
    }

    /**
     * @param string $url
     * @param $expect
     * @dataProvider dpWrongPostpendedUrls
     * @depends testUrlCanBePostpendedWithAnything
     */
    public function testUrlMustBePostpendedCorrectly($url, $expect)
    {
        $resolver = $this->resolver;
        $resolver->setMap($this->getCustomTestMap());
        $this->assertNull($resolver->resolveUrl($url), 'Resolver matches Url that should not be matched.');
    }
    /**
     * @param $url
     * @param $expect
     * @depends testUrlResolverResolvesKnownUrl
     * @depends testSetAndGetStrictMode
     * @dataProvider dpKnownUrls
     */
    public function testStrictModeMatchesBeginOfUrl($url, $expect)
    {
        $resolver = $this->resolver;
        $resolver->setMap($this->getCustomTestMap());
        $resolver->setOptionStrict(true);
        $this->assertSame($expect, $resolver->resolveUrl($url), 'Resolver does not resolve Url correctly.');
    }

    /**
     * @param $url
     * @param $expect
     * @depends testUrlResolverResolvesKnownUrl
     * @depends testSetAndGetStrictMode
     * @dataProvider dpPostpendedUrls
     */
    public function testStrictModeMatchesOnlyBeginOfUrl($url, $expect)
    {
        $resolver = $this->resolver;
        $resolver->setMap($this->getCustomTestMap());
        $resolver->setOptionStrict(true);
        $this->assertNull($resolver->resolveUrl($url), 'Resolver does not resolve Url correctly.');
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
