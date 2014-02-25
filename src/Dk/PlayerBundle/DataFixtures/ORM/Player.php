<?php
namespace Dk\PlayerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dk\PlayerBundle\Entity\Player;
use Dk\CharacterBundle\Entity\PlayerCharacter;

class LoadPlayerData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $player = new Player();
        $player->setNickname('Laurent');
        
        $character = new PlayerCharacter();
        $character->setFirstname('Lamache');
        $character->setLastname('Gordillo');
        
        $player->addCharacter($character);
                
        $manager->persist($player);
        
        $player = new Player();
        $player->setNickname('Tiphaine');

        $manager->persist($player);
        
        $manager->flush();
    }
}
