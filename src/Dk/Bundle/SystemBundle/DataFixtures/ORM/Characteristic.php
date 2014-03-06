<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Dk\Bundle\SystemBundle\Entity\Characteristic;

class LoadCharacteristicData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $ruleset = $this->getReference('ruleset-1');
        
        $chars = ['FOR', 'DEX', 'CON', 'INT', 'SAG', 'CHA'];
        
        foreach($chars as  $i => $c) {
            
            $char = new Characteristic();
            
            $char
                 ->setShortname($c)
                 ->setLongname($c)
                 ->setDescription($c)
                 ->setRuleset($ruleset)
            ;
            
            $this->addReference(sprintf('char-%d', $i), $char);
            
            $manager->persist($char);
        }
        
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }

    
}
