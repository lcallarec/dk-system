<?php

namespace Dk\Bundle\SystemBundle\Events\Subscriber;

use Dk\Bundle\SystemBundle\Events\PlayerCharacterEvent;
use Dk\Bundle\SystemBundle\PlayerCharacterEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

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
            PlayerCharacterEvents::PRE_PERSIST => [
                ['setAssociationsOnCreation', 0]
            ]
        ];
    }

    /**
     * @param PlayerCharacterEvent $event
     */
    public function setAssociationsOnCreation(PlayerCharacterEvent $event)
    {
        $pc = $event->getPlayerCharacter();

        //With no characteristics...
        if ($pc->getCharacteristics()->isEmpty()) {

            $ruleChars = $pc->getCampaign()->getRuleset()->getCharacteristics();

            foreach ($ruleChars as $rc) {
                $char = new PlayerCharacterCharacteristic();
                $char->setValue(0);
                $char->setRulesetCharacteristic($rc);

                $pc->addCharacteristic($char);
            }
        }

        if ($pc->getSkills()->isEmpty()) {

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