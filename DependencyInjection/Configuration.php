<?php

namespace OW\FileHelperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ow_file_helper');

        $rootNode
            ->children()
                ->scalarNode('upload_root_dir')->defaultValue('var/uploads')->isRequired()->end()
                ->arrayNode('channels')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('name')->isRequired()->end()
                            ->scalarNode('target_dir')->isRequired()->end()
                            ->booleanNode('save_original_filename')->defaultValue(false)->end()
                        ->end()
                    ->end()
            ->end();


        return $treeBuilder;
    }
}
