<?php

namespace Dk\Bundle\SystemBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Dk\Bundle\SystemBundle\DependencyInjection\Compiler\FactoriesCompilerPass;

/**
 * Class DkSystemBundle
 *
 * @package Dk\Bundle\SystemBundle
 */
class DkSystemBundle extends Bundle
{

    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FactoriesCompilerPass());
    }
}
