<?php

namespace Cocoders\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class FileSourceCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('cocoders_file_archive.file_source.registry')) {
            return;
        }

        $definition = $container->getDefinition(
            'cocoders_file_archive.file_source.registry'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'cocoders_file_archive.file_source'
        );
        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $definition->addMethodCall(
                    'registerFileSource',
                    array($attributes['alias'], new Reference($id))
                );
            }
        }
    }
}
