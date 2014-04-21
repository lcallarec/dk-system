<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Dk\Bundle\SystemBundle\Entity\RulesetPlayableRace;

class LoadRulesetPlayableRaceData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        return true;
        $races = [
          ['name' => 'Humain'], ['name' => 'Gros nain qui pue']  
        ];
        
        foreach($races as $r) {
            
            $race = new RulesetPlayableRace();
            
            $race
                    ->setName($r['name'])
                    ->setRuleset($this->getReference('ruleset-1'))
            ;
            
            $manager->persist($race);
           
        }
        
        $races = [
          ['name' => 'Humain custom'], ['name' => 'Gros nain qui pue custom']  
        ];
        
        foreach($races as $r) {
            
            $race = new RulesetPlayableRace();
            
            $race
                    ->setName($r['name'])
                    ->setRuleset($this->getReference('ruleset-2'))
            ;
            
            $manager->persist($race);
           
        }
        
        $manager->flush();
  
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 6;
    }

    
}
