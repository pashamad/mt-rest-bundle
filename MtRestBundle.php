<?php

namespace Mt\RestBundle;

use Mt\RestBundle\DependencyInjection\Compiler\DefinitionLoaderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MtRestBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DefinitionLoaderPass());
    }
}
