<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerCharacterSkill
 *
 */
class PlayerCharacterSkill
{
    /**
     * @var integer
     *

     */
    private $id;

    /**
     * @var integer
     */
    private $value;

    /**
     *
     * @var PlayerCharacter
     */
    private $playerCharacter;
    
    /**
     *
     * @var RulesetSkill
     */
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
     * @param integer $value
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
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }
    
    public function getRulesetSkill()
    {
        return $this->rulesetSkill;
    }
    
    public function setRulesetSkill(RulesetSkill $skill)
    {
        $this->rulesetSkill = $skill;
        
        return $this;
    }
    
    public function setPlayerCharacter(PlayerCharacter $pc)
    {
        $this->playerCharacter = $pc;
    }    
}
