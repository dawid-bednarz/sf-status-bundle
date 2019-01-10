<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\StatusBundle\DependencyInjection\Compiler;

use DawBed\ContextBundle\DependencyInjection\Configuration;
use DawBed\ContextBundle\DependencyInjection\ContextExtension;
use DawBed\StatusBundle\Service\EntityService;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ContextDiscriminatorMapPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $entityService = $container->get(EntityService::class);
        $config = $container->getExtensionConfig(ContextExtension::ALIAS);
        $container->getExtension(ContextExtension::ALIAS)->load(array_merge($config, [[Configuration::NODE_DISCRIMINATOR_MAP => [
            $entityService->Status => $entityService->Status
        ]]]), $container);
    }
}