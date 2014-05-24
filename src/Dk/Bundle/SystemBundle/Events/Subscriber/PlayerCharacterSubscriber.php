<?php

namespace Dk\Bundle\SystemBundle\Events\Subscriber;

use Dk\Bundle\SystemBundle\Events\PlayerCharacterEvent;
use Dk\Bundle\SystemBundle\PlayerCharacterEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacterCharacteristic;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacterSkill;

/**
 * Class PlayerCharacterSubscriber
 *
 * @package Dk\Bundle\SystemBundle\Events\Subscriber
 */
class PlayerCharacterSubscriber implements EventSubscriberInterface
{
    /**
     * {@ineritDoc}
     */
    static public function getSubscribedEvents()
    {
        return [
            PlayerCharacterEvents::RETRIEVED => [
                ['setMissingData', -1024]
            ]
        ];
    }

    /**
     * @param PlayerCharacterEvent $event
     */
    public function setMissingData(PlayerCharacterEvent $event)
    {
        $pc = $event->getPlayerCharacter();

        if ($pc->getCampaign() && $pc->getCharacteristics()->isEmpty()) {

            if ($ruleChars = $pc->getCampaign()->getRuleset()->getCharacteristics()) {
                foreach ($ruleChars as $rc) {
                    $char = new PlayerCharacterCharacteristic();
                    $char->setValue(0);
                    $char->setRulesetCharacteristic($rc);

                    $pc->addCharacteristic($char);
                }

                $ruleSkills = $pc->getCampaign()->getRuleset()->getSkills();
                foreach ($ruleSkills as $rs) {
                    $skill = new PlayerCharacterSkill();
                    $skill->setValue(0);
                    $skill->setRulesetSkill($rs);

                    $pc->addSkill($skill);
                }
            }
        }
    }
} 