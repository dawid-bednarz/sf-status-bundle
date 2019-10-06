<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\StatusBundle\DependencyInjection;

use DawBed\PHPClassProvider\ClassProvider;
use DawBed\StatusBundle\Entity\AbstractStatus;
use DawBed\StatusBundle\Provider;
use DawBed\StatusBundle\Repository\StatusRepository;
use DawBed\PHPUser\Context;
use DawBed\StatusBundle\PersistListener;
use DawBed\UserBundle\Service\StatusService;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class StatusExtension extends Extension implements PrependExtensionInterface
{
    const ALIAS = 'dawbed_status_bundle';

    public function getAlias(): string
    {
        return self::ALIAS;
    }

    public function prepend(ContainerBuilder $container): void
    {
        $container->setParameter('bundle_dir', dirname(__DIR__));
        $loader = $this->prepareLoader($container);
        $loader->load('services.yaml');
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $statuses = $this->getStatuses($configs);
        $configs = $this->processConfiguration($configuration, $configs);
        $this->prepareLoader($container);
        $this->prepareProvider($statuses, $container);
        $this->prepareEntityProvider($configs['entities'], $container);
        $this->prepareStatusRepository($configs['entities'][AbstractStatus::class], $container);
    }

    private function prepareLoader(ContainerBuilder $containerBuilder): YamlFileLoader
    {
        return new YamlFileLoader($containerBuilder, new FileLocator(dirname(__DIR__) . '/Resources/config'));
    }

    private function prepareStatusRepository(string $entity, ContainerBuilder $container): void
    {
        $container->setDefinition(StatusRepository::class, new Definition(StatusRepository::class, [
            new Reference(ManagerRegistry::class),
            $entity
        ]));
    }

    private function prepareProvider(array $statuses, ContainerBuilder $container): void
    {
        $container->setDefinition(Provider::class, new Definition(Provider::class, [
            $statuses,
            new Reference(EntityManagerInterface::class)
        ]));
    }

    private function prepareEntityProvider(array $entities, ContainerBuilder $container): void
    {
        foreach ($entities as $name => $class) {
            ClassProvider::add($name, $class);
        }
    }
    
    private function getStatuses(array $configs): array
    {
        $types = [];

        foreach ($configs as $config) {
            if (array_key_exists(Configuration::NODE_STATUSES, $config)) {
                foreach ($config[Configuration::NODE_STATUSES] as $type => $data) {
                    if (array_key_exists($type, $types)) {
                        throw new \Exception(sprintf('Duplicate Type "%s"', $value));
                    }
                    $types[$type] = $data;
                }
            }
        }
        return $types;
    }
}