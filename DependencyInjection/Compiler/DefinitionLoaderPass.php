<?php

namespace Mt\RestBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DefinitionLoaderPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('mt_rest.endpoint.definition_loader')) {
            return;
        }

        $loaderDefinition = $container->findDefinition('mt_rest.endpoint.definition_loader');

        $tagged = $container->findTaggedServiceIds('mt_rest.endpoint.definition_collection');

        foreach ($tagged as $id => $tags) {
            $loaderDefinition->addMethodCall('loadCollection', [new Reference($id)]);
        }
    }
}
