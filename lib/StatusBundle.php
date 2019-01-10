<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\StatusBundle;

use DawBed\StatusBundle\DependencyInjection\Compiler\ContextDiscriminatorMapPass;
use DawBed\StatusBundle\DependencyInjection\Compiler\DoctrineResolveTargetEntityPass;
use DawBed\StatusBundle\DependencyInjection\StatusExtension;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class StatusBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineResolveTargetEntityPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1000);
        $container->addCompilerPass(new ContextDiscriminatorMapPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 0);
    }

    public function getContainerExtension(): StatusExtension
    {
        return new StatusExtension();
    }
}