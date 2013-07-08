<?php

namespace Sescandell\SimpleNewsletterBundle\DependencyInjection;

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
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sescandell_simple_newsletter');

        $rootNode
            ->children()
                // Global section
                ->scalarNode('newsletter_class')->isRequired()->cannotBeEmpty()->end()
                // Service Section
                ->arrayNode('service')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('newsletter_manager')->defaultValue('sescandell_simple_newsletter.newsletter_manager.default')->end()
                        ->scalarNode('recipient_manager')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('sender')->isRequired()->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('twig_swift_sender')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('email')->defaultValue('no-reply@example.com')->end()
                        ->scalarNode('fullname')->defaultValue('example')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
