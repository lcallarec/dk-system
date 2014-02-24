<?php
namespace Dk\PlayerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Dk\PlayerBundle\Entity\Player;

class LoadPlayerData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $player = new Player();
        $player->setNickname('Laurent');

        $manager->persist($player);
        $manager->flush();
    }
}
