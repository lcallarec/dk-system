<?php
namespace Dk\PlayerBundle\Tests\Entity;

use Dk\PlayerBundle\Entity\Player;
use Dk\CharacterBundle\Entity\PlayerCharacter;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Player
     */
    private $player;
    
    /**
     *
     * @var PlayerCharacter 
     */
    private $pc;
    
    public function setUp() {
        $this->player = new Player();
        $this->player->setNickname('Laurent');
        
        $this->pc = new PlayerCharacter();
        $this->pc->setFirstname('Lamache');
        $this->pc->setLastname('Gordillo');
        
        $this->player->addCharacter($this->pc);
        
    }
    
    public function testGetNickname() {
        $this->assertEquals('Laurent', $this->player->getNickname());
    }
    
    public function testGetCharacters() {
        foreach($this->player->getCharacters() as $character) {
            $this->assertInstanceOf('Dk\CharacterBundle\Entity\PlayerCharacter', $character, "Le personnage est bien une instance de PlayerCharacter");
        }
    }
    
    public function testHasCharacters() {
        $this->assertContains($this->pc, $this->player->getCharacters(), "Le personnage est présent dans la collection du joueur");
    }
}
