<?php

namespace Dk\Bundle\SystemBundle\Manager;

use Dk\Bundle\SystemBundle\Entity\Entity;

/**
 * Interface ManagerInterface
 *
 * @package Dk\Bundle\SystemBundle\Manager
 */
interface ManagerInterface
{
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository();
}