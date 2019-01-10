<?php
/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */
declare(strict_types=1);

namespace DawBed\StatusBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class CreateService extends \DawBed\ContextBundle\Service\CreateService
{
    function __construct(EntityManagerInterface $entityManager, SupportService $supportService)
    {
        $this->supportService = $supportService;
        $this->entityManager = $entityManager;
    }
}