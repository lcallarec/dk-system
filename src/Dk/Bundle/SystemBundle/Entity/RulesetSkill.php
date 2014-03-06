<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetSkill
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RulesetSkill
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
     *
     * @var Ruleset
     * @ORM\ManyToOne(targetEntity="Ruleset", inversedBy="skills")
     * @ORM\JoinColumn(nullable=false) 
     */
    private $ruleset;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=96)
     */
    private $name;
        
    /**
     * 
     * @var Characteristic
     * @ORM\ManyToOne(targetEntity="Characteristic")
     * @ORM\JoinColumn(nullable=false) 
     */
    private $char1;

    /**
     * 
     * @var Characteristic
     * @ORM\ManyToOne(targetEntity="Characteristic")
     * @ORM\JoinColumn(nullable=false) 
     */
    private $char2;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="overload_malus", type="boolean")
     */
    private $overloadMalus;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * @return RulesetSkill
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
     * @return RulesetSkill
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
     * @return RulesetSkill
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
     * Get the first characteristic for this ruleskill
     * 
     * @return Characteristic
     */
    public function getChar1()
    {
        return $this->char1;
    }
    
    /**
     * Get the second characteristic for this ruleskill
     * 
     * @return Characteristic
     */    
    public function getChar2()
    {
        return $this->char2;
    }
    
    /**
     * Set the fist characteristic for this ruleskill 
     * 
     * @param \Dk\Bundle\SystemBundle\Entity\Characteristic $char
     * @return \Dk\Bundle\SystemBundle\Entity\RulesetSkill
     */
    public function setChar1(Characteristic $char)
    {
        $this->char1 = $char;
        
        return $this;
    }
    
    /**
     * Set the second characteristic for this ruleskill
     * 
     * @param \Dk\Bundle\SystemBundle\Entity\Characteristic $char
     * @return \Dk\Bundle\SystemBundle\Entity\RulesetSkill
     */
    public function setChar2(Characteristic $char)
    {
        $this->char2 = $char;
        
        return $this;
    }    
    
    /**
     * Set the ruleset
     * 
     * @param \Dk\Bundle\SystemBundle\Entity\Ruleset $ruleset
     * @return \Dk\Bundle\SystemBundle\Entity\RulesetSkill
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
        
        return $this;
    }
}
