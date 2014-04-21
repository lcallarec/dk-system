<?php

namespace Dk\Bundle\SystemBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FactoriesCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $def = $container->findDefinition('dk.factory.pc');
        $def->setClass($container->getParameter('dk_factory.pc_class'));

        $def = $container->findDefinition('dk.factory.campaign');
        $def->setClass($container->getParameter('dk_factory.campaign_class'));
    }
}
