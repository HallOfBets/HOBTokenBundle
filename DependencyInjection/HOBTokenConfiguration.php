<?php
namespace HOB\TokenBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Class CommonBundleConfiguration
 * @package HOB\CommonBundle\DependencyInjection
 */
class HOBTokenConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder    = new TreeBuilder();
        $rootNode       = $treeBuilder->root('hob_token_bundle');

        return $treeBuilder;
    }
}
