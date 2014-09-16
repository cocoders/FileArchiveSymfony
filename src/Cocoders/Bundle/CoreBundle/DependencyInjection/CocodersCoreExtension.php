<?php

namespace Cocoders\Bundle\CoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class CocodersCoreExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('in-memory.xml');
        $loader->load('dropbox-oauth.xml');
        $loader->load('archive.xml');
        $loader->load('uploaded-archive.xml');
        $loader->load('upload-provider.xml');
        $loader->load('file-source.xml');
        $loader->load('use-case.xml');
        $loader->load('my-file-source.xml');
        $loader->load('my-upload-provider.xml');
        $loader->load('doctrine-orm.xml');
    }
}
