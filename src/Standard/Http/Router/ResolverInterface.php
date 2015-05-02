<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Http\Router;


interface ResolverInterface
{

    /**
     * @param string $url
     * @return string
     */
    public function resolveUrl($url);
}