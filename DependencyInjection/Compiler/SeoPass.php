<?php
namespace Bundle\SeoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class SeoPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('twig')) {
            if (!$container->hasDefinition('twig.extension.seo')) {
                return;
            }
        }
    	
        if ($container->hasDefinition('templating')) {
            if (!$container->hasDefinition('templating.helper.seo')) {
                return;
            }
        }

        $objects = array();
        
        foreach ($container->findTaggedServiceIds('seo') as $id => $attributes) {
            if (isset($attributes[0]['alias'])) {
                $objects[$attributes[0]['alias']] = $id;
            }
        }
        
        $container->setParameter('seo.services', $objects);
    }
}
