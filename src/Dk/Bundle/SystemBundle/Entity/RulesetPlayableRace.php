<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetPlayableRace
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RulesetPlayableRace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=48)
     */
    private $name;

    /**
     *
     * @var Ruleset
     * @ORM\ManyToOne(targetEntity="Ruleset", inversedBy="playableRaces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruleset;
    
    /**
     * Get the string representation of this race
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
     * @return RulesetPlayableRace
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
     * @return RulesetCharacteristic
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
        
        return $this;
    }    
}
