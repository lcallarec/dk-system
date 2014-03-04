<?php
namespace Dk\Bundle\SystemBundle\Tests\Entity;

use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;
use Dk\Bundle\SystemBundle\Entity\Player;

class PlayerCharacterTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var PlayerCharacter
     */
    private $pc;
    
    /**
     * @var Player
     */
    private $player;    
    
    public function setUp() {
        
        $this->pc = new PlayerCharacter();
        $this->pc->setFirstname('Lamache');
        $this->pc->setLastname('Gordillo');
        
        $this->player = new Player();
        
        $this->pc->setPlayer($this->player);
    }
    
    public function testGetFirstname() {
        $this->assertEquals('Lamache', $this->pc->getFirstname(), "Le prénom du personnage est juste");
    }
    
    public function testGetLastname() {
        $this->assertEquals('Gordillo', $this->pc->getLastname(), "Le nom du personnage est juste");
    }
    
    public function testGetPlayer() {
        $this->assertInstanceOf('Dk\Bundle\SystemBundle\Entity\Player', $this->pc->getPlayer(), "Le joueur est bien une instance de Player");
    }
}
