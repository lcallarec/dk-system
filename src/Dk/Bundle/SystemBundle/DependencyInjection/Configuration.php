<?php

namespace Dk\Bundle\SystemBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();

        $builder->root('dk_system')
                ->children()
                    ->scalarNode('dk_factory_pc_class')
                        ->defaultValue('Dk\Bundle\SystemBundle\Factory\PlayerCharacterFactory')
                    ->scalarNode('dk_factory_campaign_class')
                        ->defaultValue('Dk\Bundle\SystemBundle\Factory\CampaignFactory')
                    ->end()
                ->end()
        ->end()
        ;

        return $builder;
    }
}
