<?php
/**
 * Created by Tobias Ranft <coded@ranft.biz> 2015
 */
namespace Standard\Http;


use Standard\Http\Router\ResolverInterface;

class Router
{
    /**
     * @var ResolverInterface[]
     */
    private $resolverChain = [];

    private $idCounter = 0;

    /**
     * @param ResolverInterface $resolver
     * @return int
     */
    public function addResolver(ResolverInterface $resolver)
    {
        return array_push($this->resolverChain, $resolver)-1;
    }

    /**
     * @param $id
     * @return ResolverInterface
     */
    public function getResolver($id)
    {
        return $this->resolverChain[$id];
    }

    /**
     * @param string $url
     * @return string
     */
    public function getRoutMatch($url)
    {
        foreach ($this->resolverChain as $resolver) {
            $match = $resolver->resolveUrl($url);
            if ($match !== null) {
                return $match;
            }
        }
        return null;
    }
}