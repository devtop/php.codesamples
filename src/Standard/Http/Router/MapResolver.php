<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */

namespace Standard\Http\Router;


class MapResolver implements ResolverInterface
{
    /**
     * @var array
     */
    private $map = [];

    /**
     * @var bool
     */
    private $strictMode = false;

    /**
     * @param string $url
     * @return string|null
     */
    public function resolveUrl($url)
    {
        if ($this->strictMode) {
            return $this->matchUrlStrict($url);
        }
        else {
            return $this->matchUrl($url);
        }
    }

    /**
     * @param array $map
     */
    public function setMap(array $map)
    {
        $this->map = $map;
    }

    /**
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param bool $useStrict
     */
    public function setOptionStrict($useStrict)
    {
        $this->strictMode = (bool)$useStrict;
    }

    /**
     * @return bool
     */
    public function getOptionStrict()
    {
        return $this->strictMode;
    }

    /**
     * @param string $url
     * @return null|string
     */
    private function matchUrl($url)
    {
        foreach ($this->map as $routeId => $routeUrl) {
            if ($url === $routeUrl) {
                return $routeId;
            }
            elseif (strpos($url, $routeUrl.'/') === 0) {
                return $routeId;
            }
            elseif (strpos($url, $routeUrl.'?') === 0) {
                return $routeId;
            }
        }
        return null;
    }

    /**
     * @param string $url
     * @return null|string
     */
    private function matchUrlStrict($url)
    {
        foreach ($this->map as $routeId => $routeUrl) {
            if ($url === $routeUrl) {
                return $routeId;
            }
        }
        return null;
    }
}