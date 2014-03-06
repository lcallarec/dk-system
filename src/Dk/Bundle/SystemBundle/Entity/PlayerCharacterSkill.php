<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerCharacterSkill
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PlayerCharacterSkill
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
     * @var integer
     *
     * @ORM\Column(name="value", type="smallint")
     */
    private $value;

    /**
     *
     * @var PlayerCharacter
     * @ORM\ManyToOne(targetEntity="PlayerCharacter", inversedBy="skills") 
     */
    private $playerCharacter;
    
    /**
     *
     * @var RulesetSkill
     * @ORM\ManyToOne(targetEntity="RulesetSkill") 
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
