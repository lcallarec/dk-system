<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerCharacterSkill
 */
class PlayerCharacterSkill
{
    /** @var int */
    private $id;

    /** @var int */
    private $value;

    /** @var PlayerCharacter */
    private $playerCharacter;
    
    /** @var RulesetSkill */
    private $rulesetSkill;

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
     * @param int $value
     *
     * @return PlayerCharacterSkill
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return RulesetSkill
     */
    public function getRulesetSkill()
    {
        return $this->rulesetSkill;
    }

    /**
     * @param RulesetSkill $skill
     *
     * @return $this
     */
    public function setRulesetSkill(RulesetSkill $skill)
    {
        $this->rulesetSkill = $skill;
        
        return $this;
    }

    /**
     * @param PlayerCharacter $pc
     */
    public function setPlayerCharacter(PlayerCharacter $pc)
    {
        $this->playerCharacter = $pc;
    }    
}
