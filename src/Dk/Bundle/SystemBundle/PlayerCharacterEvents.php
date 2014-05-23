<?php

namespace Dk\Bundle\SystemBundle;

/**
 * Class PlayerCharacterEvents
 *
 * @package Dk\Bundle\SystemBundle
 */
final class PlayerCharacterEvents
{
    /**
     * This event is triggered before PlayerCharacter persist
     *
     * @const string
     */
    const PRE_PERSIST = 'dk.pc.pre_persist.event';

    /**
     * This event is triggered before PlayerCharacter persist
     *
     * @const string
     */
    const POST_FACTORY_CREATION = 'dk.pc.post_factory_creation.event';
} 