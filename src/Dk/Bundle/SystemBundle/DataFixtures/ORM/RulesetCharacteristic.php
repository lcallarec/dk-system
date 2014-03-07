<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Dk\Bundle\SystemBundle\Entity\RulesetCharacteristic;

class LoadRulesetCharacteristicData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $ruleset = $this->getReference('ruleset-1');
        
        $chars = ['FOR', 'DEX', 'CON', 'INT', 'SAG', 'CHA'];
        
        foreach($chars as  $i => $c) {
            
            $char = new RulesetCharacteristic();
            
            $char
                 ->setShortname($c)
                 ->setLongname($c)
                 ->setDescription($c)
                 ->setRuleset($ruleset)
            ;
            
            $this->addReference(sprintf('rs1-char-%d', $i), $char);
            
            $manager->persist($char);
        }
        
        $ruleset = $this->getReference('ruleset-2');
        
        $chars = ['STR', 'AGI', 'BON', 'COUR', 'KA', 'BLO', 'RUM', 'EQU'];
        
        foreach($chars as  $i => $c) {
            
            $char = new RulesetCharacteristic();
            
            $char
                 ->setShortname($c)
                 ->setLongname($c)
                 ->setDescription($c)
                 ->setRuleset($ruleset)
            ;
            
            $this->addReference(sprintf('rs2-char-%d', $i), $char);
            
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
