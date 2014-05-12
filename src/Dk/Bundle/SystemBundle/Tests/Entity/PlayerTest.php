<?php

namespace Dk\Bundle\SystemBundle\Tests\Entity;

use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PlayerCharacter */
    protected $pc;

    public function testGetNickname()
    {
        $player = $this->getPlayer();

        $this->assertEquals('Laurent', $player->getNickname());
        $this->assertEquals('laurent@email.com', $player->getEmail());
    }

    public function testPlayerCharacters()
    {
        $player = $this->getPlayer();

        $pc = $this->getPlayerCharacter($player);

        $player->addCharacter($pc);

        $this->assertContains($pc, $player->getCharacters(), "Le personnage est présent dans la collection du joueur");

        foreach ($this->player->getCharacters() as $character) {
            $this->assertInstanceOf(
                'Dk\CharacterBundle\Entity\PlayerCharacter',
                $character,
                'Player object is instance of Dk\CharacterBundle\Entity\PlayerCharacter'
            );
        }
    }

    /**
     * @return Player
     */
    protected function getPlayer()
    {
        $player = new Player();
        $player->setNickname('Laurent');
        $player->setEmail('laurent@email.com');

        return $player;
    }

    /**
     * @param Player $player
     * @return PlayerCharacter
     */
    protected function getPlayerCharacter(Player $player)
    {
        $pc = new PlayerCharacter($player);
        $pc->setFirstname('Lamache');
        $pc->setLastname('Gordillo');

        return $pc;
    }
}
