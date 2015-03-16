<?php

namespace Seven\Bundle\OneskyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('seven_onesky');

        $rootNode
            ->children()
                ->scalarNode('api_key')->isRequired()->end()
                ->scalarNode('secret')->isRequired()->end()
                ->scalarNode('project')->isRequired()->end()
                ->arrayNode('mappings')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('sources')->prototype('scalar')->end()->end()
                            ->arrayNode('locales')->prototype('scalar')->end()->end()
                            ->scalarNode('output')->defaultValue('[filename].[locale].[extension]')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
