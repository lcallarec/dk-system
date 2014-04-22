<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;

class LoadPlayerData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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

   
        $player
                ->setNickname('Laurent')
                ->setEmail('l.callarec@gmail.com')
                ->setRoles(['ROLE_MASTER_RULESET'])
        ;
        
        $this->addReference($player->getEmail(), $player);
        
        $character = new PlayerCharacter($player);
        
        $character
                ->setFirstname('Lamache')
                ->setLastname('Gordillo')
        ;
        
        $player->addCharacter($character);
        $this->addReference('pc-1', $character);
        
        $character = new PlayerCharacter($player);
            
        $character
                ->setFirstname('Chew')
                ->setLastname('Bakka')
        ;
        
        $player->addCharacter($character);
        $this->addReference('pc-2', $character);
 
        $character = new PlayerCharacter($player);
            
        $character
                ->setFirstname('bob')
                ->setLastname('Eponge')
        ;
        $player->addCharacter($character);
        
        $manager->persist($player);
        
        $player = new Player();
        
        $encoder = $efactory->getEncoder($player);
        $password = $encoder->encodePassword('azer', $player->getSalt());
        
        $player->setPassword($password);
        
        $player
                ->setNickname('Autre')
                ->setEmail('lcallarec@openmailbox.org')
                ->setRoles(['ROLE_PLAYER'])
        ;
        
        $manager->persist($player);                

        $player = new Player();
        $encoder = $efactory->getEncoder($player);
        $password = $encoder->encodePassword('azer', $player->getSalt());
        
        $player->setPassword($password);
        
        $player
                ->setNickname('Master ruleset')
                ->setEmail('lcallarec@gmail.com')
                ->setRoles(['ROLE_MASTER_RULESET'])
        ;
        $this->addReference('p3-master-ruleset', $player);
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
