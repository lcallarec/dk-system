<?php
namespace Dk\PlayerBundle\Tests\Entity;

use Dk\PlayerBundle\Entity\Player;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var Player
     */
    private $player;
    
    public function setUp() {
        $this->player = new Player();
        $this->player->setNickname('Laurent');
    }
    
    public function testGetNickname() {
        $this->assertEquals('Laurent', $this->player->getNickname());
    }
}
