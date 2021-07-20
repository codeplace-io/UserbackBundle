<?php
declare(strict_types=1);

namespace Codeplace\UserbackBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('codeplace_userback');
        $rootNode = \method_exists(TreeBuilder::class, 'getRootNode') ?
            $treeBuilder->getRootNode() : $treeBuilder->root('codeplace_userback');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('enable')
                    ->defaultTrue()
                ->end()
                ->scalarNode('access_token')
                    ->isRequired()
                ->end()
                ->booleanNode('auto_inject')
                    ->defaultTrue()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
