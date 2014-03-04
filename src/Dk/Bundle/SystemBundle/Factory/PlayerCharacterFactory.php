<?php
namespace Dk\Bundle\SystemBundle\Factory;

use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;

/**
 * Create player character (via service container)
 *
 * @author laurent
 */
class PlayerCharacterFactory
{
    /**
     *
     * @var Player 
     */
    private $player;
    
    /**
     * 
     * @param Player $pc
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }
    
    public function create()
    {
        return new PlayerCharacter($this->player);
    }
}
