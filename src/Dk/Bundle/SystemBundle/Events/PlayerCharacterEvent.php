<?php

namespace Dk\Bundle\SystemBundle\Events;

use Symfony\Component\EventDispatcher\Event;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;

/**
 * Class PlayerCharacterEvent
 * @package Dk\Bundle\SystemBundle\Events
 */
class PlayerCharacterEvent extends Event
{
    /** @var PlayerCharacter */
    private $pc;

    /**
     * @param PlayerCharacter $pc
     */
    public function __construct(PlayerCharacter $pc)
    {
       $this->pc = $pc;
    }

    /**
     * @return PlayerCharacter
     */
    public function getPlayerCharacter()
    {
        return $this->pc;
    }
} 