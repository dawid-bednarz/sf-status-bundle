<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\StatusBundle\DependencyInjection;

use DawBed\ComponentBundle\Configuration\Entity;
use DawBed\PHPStatus\Status;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const NODE_STATUSES = 'types';

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(StatusExtension::ALIAS);

        $this->statuses($rootNode);

        $entity = new Entity($rootNode);
        $entity->new('status', Status::class);
        $entity->end();

        return $treeBuilder;
    }

    private function statuses(ArrayNodeDefinition $status): void
    {
        $status
            ->children()
            ->arrayNode(self::NODE_STATUSES)
            ->scalarPrototype()
            ->validate()
            ->ifTrue(function ($v) {
                return !is_int($v);
            })->thenInvalid('Status must be an integer type');
    }

}