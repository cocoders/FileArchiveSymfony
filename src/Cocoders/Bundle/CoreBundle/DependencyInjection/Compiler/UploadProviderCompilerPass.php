<?php

namespace Cocoders\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class UploadProviderCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('cocoders_file_archive.upload_provider.registry')) {
            return;
        }

        $definition = $container->getDefinition(
            'cocoders_file_archive.upload_provider.registry'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'cocoders_file_archive.upload_provider'
        );
        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall(
                    'registerUploadProvider',
                    array($attributes['alias'], new Reference($id))
                );
            }
        }
    }
}
