<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Dk\Bundle\SystemBundle\Entity\Campaign;

class LoadCampaignData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
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
        $campaign = new Campaign();
        $campaign->setName('My first campaign');
        $campaign->addPlayerCharacter($this->getReference('pc-1'));
        
        $manager->persist($campaign);
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
