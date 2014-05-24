<?php

namespace Dk\Bundle\SystemBundle\Manager;

use Dk\Bundle\SystemBundle\PlayerCharacterEvents;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;
use Dk\Bundle\SystemBundle\Events\PlayerCharacterEvent;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class PlayerCharacterManager
 *
 * @package Dk\Bundle\SystemBundle\Manager
 */
class PlayerCharacterManager implements ManagerInterface
{
    /** @var EntityManager */
    private $em;

    /** @var EntityRepository  */
    private $repository;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /** @var Player */
    private $player;

    /**
     * @param UserInterface            $player
     * @param EntityManager            $em
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(UserInterface $player, EntityManager $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->player          = $player;
        $this->em              = $em;
        $this->repository      = $em->getRepository('DkSystemBundle:PlayerCharacter');
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param $id
     * @return PlayerCharacter
     */
    public function get($id)
    {
        $pc = $this->getRepository()->findOneById($id);

        $this->eventDispatcher->dispatch(PlayerCharacterEvents::POST_RETRIEVED, new PlayerCharacterEvent($pc));

        return $pc;
    }

    /**
     * @param $id
     * @return PlayerCharacter
     */
    public function getWithRelationships($id)
    {
        $pc = $this->getRepository()->findOneWithRelationships($this->player, $id);

        $this->eventDispatcher->dispatch(PlayerCharacterEvents::POST_RETRIEVED, new PlayerCharacterEvent($pc));

        return $pc;
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