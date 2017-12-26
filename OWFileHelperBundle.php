<?php

namespace OW\FileHelperBundle;

use OW\FileHelperBundle\DependencyInjection\Compiler\FileHelperPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OWFileHelperBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FileHelperPass());
    }
}
