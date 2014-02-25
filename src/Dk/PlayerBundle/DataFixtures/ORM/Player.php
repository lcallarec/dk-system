<?php
namespace Dk\PlayerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dk\PlayerBundle\Entity\Player;
use Dk\CharacterBundle\Entity\PlayerCharacter;

class LoadPlayerData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $factory = $this->container->get('security.encoder_factory');

        $player = new Player();
        
        $encoder = $factory->getEncoder($player);
        $password = $encoder->encodePassword('azer', $player->getSalt());
        $player->setPassword($password);

   
        $player->setNickname('Laurent');
        $player->setEmail('l.callarec@gmail.com');

        
        $character = new PlayerCharacter();
        $character->setFirstname('Lamache');
        $character->setLastname('Gordillo');
        
        $player->addCharacter($character);
                
        $manager->persist($player);
        
//        $player = new Player();
//        $player->setNickname('Tiphaine');
//        //$player->setEmail('lcallarec@openmailbox.org');
//        $player->setPassword('azer');
//        
//        $manager->persist($player);
      
        $manager->flush();
    }


    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
}
