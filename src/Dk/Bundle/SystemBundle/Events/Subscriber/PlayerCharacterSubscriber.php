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
                ['setAssociationsOnPostFactoryCreation', 0]
            ]
        ];
    }

    /**
     * @param PlayerCharacterEvent $event
     */
    public function setAssociationsOnPostFactoryCreation(PlayerCharacterEvent $event)
    {
        $pc = $event->getPlayerCharacter();

        if ($pc->getCampaign()) {

            if (!$ruleChars = $pc->getCampaign()->getRuleset()->getCharacteristics()) {
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