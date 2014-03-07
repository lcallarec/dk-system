<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Dk\Bundle\SystemBundle\Entity\RulesetSkill;

class LoadRulesetSkillData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $skills = [
            
            ['name' => 'Athlétisme', 'char1' => $this->getReference('rs1-char-0'), 'char2' => $this->getReference('rs1-char-1'), 'overload_malus' => true, 'desc' => 'desc atlé'],
            ['name' => 'Bluff', 'char1' => $this->getReference('rs1-char-3'), 'char2' => $this->getReference('rs1-char-4'), 'overload_malus' => false, 'desc' => 'desc bluff']           
        ];
        
        foreach($skills as $s) {
                 
            $skill = new RulesetSkill();

            $skill
                    ->setRuleset($this->getReference('ruleset-1'))
                    ->setName($s['name'])
                    ->setOverloadMalus($s['overload_malus'])
                    ->setChar1($s['char1'])
                    ->setChar2($s['char2'])
                    ->setDescription($s['desc'])
            ;
            
            $manager->persist($skill);
            $manager->flush();
        }
  
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5;
    }

    
}
