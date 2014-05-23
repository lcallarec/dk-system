<?php

namespace Dk\Bundle\SystemBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Dk\Bundle\SystemBundle\Entity\Player;

/**
 * Class PlayerManager
 *
 * @package Dk\Bundle\SystemBundle\Manager
 */
class PlayerManager implements ManagerInterface
{
    /** @var EntityManager */
    private $em;

    /** @var EntityRepository  */
    private $repository;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * @param EntityManager            $em
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EntityManager $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->em              = $em;
        $this->repository      = $em->getRepository('DkSystemBundle:Player');
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param Player $player
     */
    public function save(Player $player)
    {
        $this->em->persist($player);
        $this->em->flush();
    }
} 