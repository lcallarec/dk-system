<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PlayerCharacterCharacteristic
 */
class PlayerCharacterCharacteristic
{
    /** @var int */
    private $id;

    /** @var PlayerCharacter */
    private $playerCharacter;

    /** @var RulesetCharacteristic */
    private $rulesetCharacteristic;
    
    /** @var int */
    private $value;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param integer $value
     *
     * @return PlayerCharacterCharacteristic
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Get the related Characteristic
     *
     * @return RulesetCharacteristic
     */
    public function getRulesetCharacteristic()
    {
        return $this->rulesetCharacteristic;
    }
    
    /**
     * Set the RulesetCharacteristic on which this Char rely on
     *
     * @param RulesetCharacteristic $char
     *
     * @return PlayerCharacterCharacteristic
     */
    public function setRulesetCharacteristic(RulesetCharacteristic $char = null)
    {
        if(null !== $char) {
            $this->rulesetCharacteristic = $char;
        }
   
        return $this;
    }
    
    /**
     * Set the PlayerCharacter who own this Char
     *
     * @param PlayerCharacter $pc
     */
    public function setPlayerCharacter(PlayerCharacter $pc)
    {
        $this->playerCharacter = $pc;
    }
}
