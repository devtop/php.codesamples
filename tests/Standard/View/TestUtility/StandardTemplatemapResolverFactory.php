<?php
namespace Standard\View\TestUtility;

use Standard\View\TemplatemapResolver;

class StandardTemplatemapResolverFactory
{
    /**
     * @return TemplatemapResolver
     */
    public function createService()
    {
        $resolver = new TemplatemapResolver();
        $resolver->setTemplatemap(self::getStandardTemplatemap());
        return $resolver;
    }

    /**
     * @return array
     */
    public static function getStandardTemplatemap()
    {
        return [
            'test' => __DIR__.'/data/test.phtml',
            'view/standard/layout' => __DIR__.'/data/layout.phtml',
            'file/not/exists' => __DIR__.'/data/filenotexists.phtml',
        ];
    }
}