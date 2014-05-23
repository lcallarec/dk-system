<?php

namespace Dk\Bundle\SystemBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Dk\Bundle\SystemBundle\Entity\Rulesetr;

/**
 * Class RulesetManager
 *
 * @package Dk\Bundle\SystemBundle\Manager
 */
class RulesetManager implements ManagerInterface
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
        $this->repository      = $em->getRepository('DkSystemBundle:Ruleset');
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
     * @param RulesetManager $ruleset
     */
    public function save(RulesetManager $ruleset)
    {
        $this->em->persist($ruleset);
        $this->em->flush();
    }
} 