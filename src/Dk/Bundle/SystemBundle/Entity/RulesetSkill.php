<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetSkill
 */
class RulesetSkill
{
    /** @var integer */
    private $id;

    /** @var Ruleset */
    private $ruleset;
    
    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var RulesetCharacteristic */
    private $char1;

    /** @var RulesetCharacteristic */
    private $char2;
    
    /** @var boolean */
    private $overloadMalus;

    /** @var RulesetSkillGroup */
    private $group;

    /**
     * Get string representation of RulesetSkill
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set overloadMalus
     *
     * @param boolean $overloadMalus
     *
     * @return $this
     */
    public function setOverloadMalus($overloadMalus)
    {
        $this->overloadMalus = $overloadMalus;

        return $this;
    }

    /**
     * Get overloadMalus
     *
     * @return boolean 
     */
    public function getOverloadMalus()
    {
        return $this->overloadMalus;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Get the first RulesetCharacteristic for this ruleskill
     * 
     * @return RulesetCharacteristic
     */
    public function getChar1()
    {
        return $this->char1;
    }
    
    /**
     * Get the second RulesetCharacteristics for this ruleskill
     * 
     * @return RulesetCharacteristic
     */    
    public function getChar2()
    {
        return $this->char2;
    }
    
    /**
     * Set the fist RulesetCharacteristics for this ruleskill 
     * 
     * @param RulesetCharacteristic $char
     *
     * @return $this
     */
    public function setChar1(RulesetCharacteristic $char)
    {
        $this->char1 = $char;
        
        return $this;
    }
    
    /**
     * Set the second characteristic for this ruleskill
     * 
     * @param RulesetCharacteristic $char
     *
     * @return $this
     */
    public function setChar2(RulesetCharacteristic $char)
    {
        $this->char2 = $char;
        
        return $this;
    }    
 
   /**
    * Get the ruleset
    *
    * @return Ruleset $ruleset
    */
    public function getRuleset()
    {
        return $this->ruleset;
    }    
    
    /**
     * Set the ruleset
     * 
     * @param Ruleset $ruleset
     *
     * @return $this
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
        
        return $this;
    }

    /**
     * Get the skill group
     *
     * @return RulesetSkillGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set the skill group
     *
     * @param RulesetSkillGroup $group
     *
     * @return $this
     */
    public function setGroup(RulesetSkillGroup $group)
    {
        $this->group = $group;

        return $this;
    }
}
