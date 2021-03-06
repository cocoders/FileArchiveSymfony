<?php

namespace Cocoders\Bundle\CoreBundle;

use Cocoders\Bundle\CoreBundle\DependencyInjection\Compiler\FileSourceCompilerPass;
use Cocoders\Bundle\CoreBundle\DependencyInjection\Compiler\UploadProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CocodersCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FileSourceCompilerPass());
        $container->addCompilerPass(new UploadProviderCompilerPass());
    }
}
