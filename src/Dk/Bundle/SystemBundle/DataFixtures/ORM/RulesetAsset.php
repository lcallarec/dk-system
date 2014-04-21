<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Dk\Bundle\SystemBundle\Entity\RulesetAsset;

class LoadRulesetAssetData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        return true;
        $assets = [
            ['name' => 'Doigts serpents', 'description' => 'DS', 'ruleset' => $this->getReference('dk-std')],
            ['name' => 'Focalisation', 'description' => 'F', 'ruleset' => $this->getReference('dk-std')]
        ];
        
        foreach($assets as $a) {
            $asset = new RulesetAsset();
            $asset 
                    ->setName($a['name'])
                    ->setDescription($a['description'])
                    ->setRuleset($a['ruleset'])
            ;
            
            $manager->persist($asset);
        }
       
        $manager->flush();
      
  
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 8;
    }

    
}
