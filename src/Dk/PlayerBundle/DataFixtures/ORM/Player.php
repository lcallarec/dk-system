<?php
namespace Dk\PlayerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dk\PlayerBundle\Entity\Player;
use Dk\CharacterBundle\Entity\PlayerCharacter;

class LoadPlayerData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        $efactory = $this->container->get('security.encoder_factory');

        $player = new Player();
        
        $encoder = $efactory->getEncoder($player);
        $password = $encoder->encodePassword('azer', $player->getSalt());
        $player->setPassword($password);

   
        $player->setNickname('Laurent');
        $player->setEmail('l.callarec@gmail.com');

        
        $character = new PlayerCharacter($player);
        $character->setFirstname('Lamache');
        $character->setLastname('Gordillo');
        
        $player->addCharacter($character);
                
        $manager->persist($player);
     
        $manager->flush();
    }


    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
    
}
