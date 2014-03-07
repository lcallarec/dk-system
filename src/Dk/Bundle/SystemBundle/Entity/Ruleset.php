<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ruleset
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\Bundle\SystemBundle\Repository\RulesetRepository")
 */
class Ruleset
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
     * The player owning this ruleset
     * @var Player 
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * @var ArrayCollection of RulesetCharacteristics
     * @ORM\OneToMany(targetEntity="RulesetCharacteristic", mappedBy="ruleset") 
     */
    private $characteristics;

    /**
     * PlayableRaces related to this ruleset
     * 
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="RulesetPlayableRace", mappedBy="ruleset")
     */
    private $playableRaces;
    
    /**
     * Skills related to this ruleset
     * 
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="RulesetSkill", mappedBy="ruleset")
     */
    private $skills;

    /**
     * Assets related to this ruleset
     * 
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="RulesetAsset", mappedBy="ruleset")
     */
    private $assets;
    
    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
    }
    
    /**
     * Get the ruleset string representation
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
     * Get the campaign owner
     * @return Player 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set the campaign owner
     * @param Player $owner
     * @return Campaign
     */
    public function setOwner(Player $owner)
    {
        $this->owner = $owner;
        
        return $this;
    }    
    
    /**
     * Set name
     *
     * @param string $name
     * @return Ruleset
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
     * Get the characteristics for this ruleset
     * @return ArrayCollection
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }
    
    /**
     * Get the skills of this ruleset
     * 
     * @return ArrayCollection
     */
    public function getSkills()
    {
        return $this->skills;
    }
    
    /**
     * Add a skill for this ruleset
     * 
     * @param Skill $skill
     * @return Ruleset
     */
    public function addSkill(RulesetSkill $skill)
    {
        $skill->setRuleset($this);
        $this->skills->add($skill);
        
        return $this;
    }
    
    /**
     * Get the playable races of this ruleset
     * 
     * @return ArrayCollection
     */
    public function getPlayableRaces()
    {
        return $this->playableRaces;
    }
    
    /**
     * Add a playable race for this ruleset
     * 
     * @param Skill $skill
     * @return Ruleset
     */
    public function addPlayableRace(RulesetPlayableRace $pr)
    {
        $pr->setRuleset($this);
        $this->playableRaces->add($pr);
        
        return $this;
    }
    
    /**
     * Get assets of this ruleset
     * 
     * @return ArrayCollection
     */
    public function getAssets()
    {
        return $this->assets;
    }
    
    /**
     * Add a skill for this ruleset
     * 
     * @param RulesetAsset $asset
     * @return Ruleset
     */
    public function addAsset(RulesetAsset $asset)
    {
        $asset->setRuleset($this);
        $this->assets->add($asset);
        
        return $this;
    }        
}
