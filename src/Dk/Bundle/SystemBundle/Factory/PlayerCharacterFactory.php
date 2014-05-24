<?php
namespace Dk\Bundle\SystemBundle\Factory;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;
use Dk\Bundle\SystemBundle\PlayerCharacterEvents;
use Dk\Bundle\SystemBundle\Events\PlayerCharacterEvent;

/**
 * Create player character (via service container)
 *
 * @author laurent
 */
final class PlayerCharacterFactory
{
    /**
     *
     * @var Player 
     */
    private $player;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * @param Player                   $player
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(Player $player, EventDispatcherInterface $eventDispatcher)
    {
        $this->player          = $player;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @return PlayerCharacter
     */
    public function create()
    {
        $pc = new PlayerCharacter($this->player);

        return $pc;
    }
}
