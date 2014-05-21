<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 21/05/14
 * Time: 21:13
 */

namespace Dk\Bundle\SystemBundle\Manager;

use Dk\Bundle\SystemBundle\PlayerCharacterEvents;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;
use Dk\Bundle\SystemBundle\Events\PlayerCharacterEvent;

/**
 * Class PlayerCharacterManager
 *
 * @package Dk\Bundle\SystemBundle\Manager
 */
class PlayerCharacterManager
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
        $this->repository      = $em->getRepository('DkSystemBundle:PlayerCharacter');
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
     * @param PlayerCharacter $pc
     */
    public function save(PlayerCharacter $pc)
    {
        $this->eventDispatcher->dispatch(PlayerCharacterEvents::PRE_PERSIST, new PlayerCharacterEvent($pc));

        $this->em->persist($pc);
        $this->em->flush();
    }
} 