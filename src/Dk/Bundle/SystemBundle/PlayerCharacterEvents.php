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
     * This event is triggered everytime a PlayerCharacter entity is unitary retrieved from database
     *
     * @const string
     */
    const RETRIEVED = 'dk.pc.retrievedt';
} 