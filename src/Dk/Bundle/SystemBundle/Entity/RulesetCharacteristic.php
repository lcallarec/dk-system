<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetCharacteristic
 *
 */
class RulesetCharacteristic
{
    /**
     * @var integer
     *

     */
    private $id;

    /**
     */
    private $ruleset;
    
    /**
     * @var string
     *
     */
    private $shortname;

    /**
     * @var string
     *
     */
    private $longname;

    /**
     * @var string
     *
     */
    private $description;


    /**
     * Get the characteristic string representation
     * @return string
     */
    public function __toString()
    {
        return strtoupper($this->shortname);
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
     * Set shortname
     *
     * @param string $shortname
     * @return RulesetCharacteristic
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string 
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set longname
     *
     * @param string $longname
     * @return RulesetCharacteristic
     */
    public function setLongname($longname)
    {
        $this->longname = $longname;

        return $this;
    }

    /**
     * Get longname
     *
     * @return string 
     */
    public function getLongname()
    {
        return $this->longname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return RulesetCharacteristic
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
     * Set the RulesetCharacteristic ruleset
     * 
     * @param Ruleset $ruleset
     * @return RulesetCharacteristic
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
        
        return $this;
    }
}
