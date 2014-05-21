<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 21/05/14
 * Time: 21:13
 */

namespace Dk\Bundle\SystemBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


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
     * @param EntityManager $em
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EntityManager $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->em         = $em;
        $this->repository = $em->getRepository('DkSystemBundle:PlayerCharacter');
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
        $this->em->persist($pc);
        $this->em->flush();
    }
} 