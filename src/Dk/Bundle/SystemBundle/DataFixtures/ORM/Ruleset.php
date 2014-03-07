<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Dk\Bundle\SystemBundle\Entity\Ruleset;

class LoadRulesetData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $ruleset = new Ruleset();
        $ruleset->setName('dk2 standard edition');
        $ruleset->setOwner($this->getReference('p3-master-ruleset'));        
        $this->addReference('ruleset-1', $ruleset);
        $manager->persist($ruleset);
        
        $ruleset = new Ruleset();
        $ruleset->setName('dk2 custom');
        $ruleset->setOwner($this->getReference('p3-master-ruleset'));
        $this->addReference('ruleset-2', $ruleset);
        $manager->persist($ruleset);
        
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }

    
}
