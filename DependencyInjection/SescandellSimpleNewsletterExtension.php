<?php

namespace Sescandell\SimpleNewsletterBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SescandellSimpleNewsletterExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('sescandell_simple_newsletter.model.newsletter.class', $config['newsletter_class']);
        $container->setAlias('sescandell_simple_newsletter.newsletter_manager', $config['service']['newsletter_manager']);
        // TODO: remove aliases, use addCall functions... no need to create "fictive" services
        $container->setAlias('sescandell_simple_newsletter.recipient_manager', $config['service']['recipient_manager']);
        $container->setAlias('sescandell_simple_newsletter.sender', $config['service']['sender']);
        $container->setAlias('sescandell_simple_newsletter.sender_to', $config['service']['sender_to']);

        /**
         * TODO: manage Propel and ODM
         */
        $container->getDefinition('sescandell_simple_newsletter.newsletter_listener')->addTag('doctrine.event_subscriber');

        $container->getDefinition('sescandell_simple_newsletter.sender.twig_swift')
            ->addArgument($config['twig_swift_sender']['email'])
            ->addArgument($config['twig_swift_sender']['fullname']);
    }
}
