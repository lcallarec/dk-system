<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetPlayableRace
 */
class RulesetPlayableRace
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Ruleset */
    private $ruleset;
    
    /**
     * Get the string representation of this race
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
     * Set the RulesetPlayableRace ruleset
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
}
