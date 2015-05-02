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
     * @param string $url
     * @return string|null
     */
    public function resolveUrl($url)
    {
        foreach ($this->map as $routeId=>$routeUrl) {
            if (strpos($url, $routeUrl)===0){
                return $routeId;
            }
        }
        return null;
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
}