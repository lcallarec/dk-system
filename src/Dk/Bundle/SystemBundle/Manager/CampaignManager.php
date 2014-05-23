<?php

namespace Dk\Bundle\SystemBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Dk\Bundle\SystemBundle\Entity\Campaign;

/**
 * Class CampaignManager
 *
 * @package Dk\Bundle\SystemBundle\Manager
 */
class CampaignManager implements ManagerInterface
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
        $this->repository      = $em->getRepository('DkSystemBundle:Campaign');
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
     * @param Campaign $campaign
     */
    public function save(Campaign $campaign)
    {
        $this->em->persist($campaign);
        $this->em->flush();
    }
} 