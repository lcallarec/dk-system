<?php
namespace Dk\CharacterBundle\Factory;

use Dk\PlayerBundle\Entity\Player;
use Dk\CharacterBundle\Entity\PlayerCharacter;

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
