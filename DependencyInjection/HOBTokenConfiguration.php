<?php
namespace HOB\TokenBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Class HOBTokenConfiguration
 * @package HOB\TokenBundle\DependencyInjection
 */
class HOBTokenConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder    = new TreeBuilder();
        $rootNode       = $treeBuilder->root('hob_token');

        $rootNode->children()
            ->booleanNode('required')
                ->defaultTrue()
            ->end()
            ->arrayNode('storage')
                ->integerNode('priority')
                    ->defaultValue(0)
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
