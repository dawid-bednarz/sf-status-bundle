<?php

namespace DawBed\StatusBundle\Command;

use DawBed\ContextBundle\Command\LoadContextCommand;
use DawBed\PHPClassProvider\ClassProvider;
use DawBed\StatusBundle\Factory;
use DawBed\StatusBundle\Provider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
class LoadStatusCommand extends LoadContextCommand
{
    const NAME = 'dawbed:status:update';

    private $provider;
    private $entityManager;

    public function __construct(?string $name = null, Provider $provider, EntityManagerInterface $entityManager)
    {
        parent::__construct($name, $provider, $entityManager);
        $this->provider = $provider;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setName(self::NAME)
            ->setDescription('Update all statuses');
    }
}