<?php

/**
 *  * Dawid Bednarz( dawid@bednarz.pro )
 * Read README.md file for more information and licence uses
 */

namespace DawBed\StatusBundle;

use DawBed\PHPClassProvider\ClassProvider;
use DawBed\StatusBundle\Entity\AbstractStatus;

class Provider extends \DawBed\ContextBundle\Provider
{
    public function getDiscriminatorName(): string
    {
        return ClassProvider::get(AbstractStatus::class);
    }
}