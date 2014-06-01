<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Le nom du système de règles ne peut être vide")
     * @Assert\Length(
     *      min = "2",
     *      max = "100",
     *      minMessage = "Le nom du système de règles ne doit pas faire moins de {{ limit }} caractères",
     *      maxMessage = "Le nom du système de règles ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=16)
     */
    private $reference;

    /**
     *
     * @var ArrayCollection of RulesetCharacteristics
     * @ORM\OneToMany(targetEntity="RulesetCharacteristic", mappedBy="ruleset", indexBy="shortname")
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
     * @Assert\Valid()
     */
    private $skills;

    /**
     * SkillGroups related to this ruleset
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="RulesetSkillGroup", mappedBy="ruleset")
     * @Assert\Valid()
     */
    private $skillGroups;

    /**
     * Assets related to this ruleset
     * 
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="RulesetAsset", mappedBy="ruleset")
     */
    private $assets;

    /**
     * Assets groups related to this ruleset
     *
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="RulesetAssetGroup", mappedBy="ruleset")
     */
    private $assetGroups;

    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
        $this->assetGroups     = new ArrayCollection();
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
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set reference
     *
     * @param $reference
     *
     * @return $this
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
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
     * Add a characteristic for this ruleset
     *
     * @param RulesetCharacteristic $characteristic
     *
     * @return Ruleset
     */
    public function addCharacteristic(RulesetCharacteristic $characteristic)
    {
        $characteristic->setRuleset($this);
        $this->characteristics->offsetSet($characteristic->getShortname(), $characteristic);

        return $this;
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
     * @param RulesetSkill $skill
     *
     * @return Ruleset
     */
    public function addSkill(RulesetSkill $skill)
    {
        $skill->setRuleset($this);
        $this->skills->add($skill);

        return $this;
    }

   /**
     * remove a skill for this ruleset
     * 
     * @param RulesetSkill $skill
    *
     * @return Ruleset
     */
    public function removeSkill(RulesetSkill $skill)
    {
        $this->skills->removeElement($skill);
        
        return $this;
    }    

   /**
     * remove a PlayableRace for this ruleset
     * 
     * @param RulesetPlayableRace $pr
     * @return Ruleset
     */
    public function removePlayableRace(RulesetPlayableRace $pr)
    {
        $this->playableRaces->removeElement($pr);
        
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
     * @param RulesetPlayableRace $pr
     *
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
    * Get asset groups of this ruleset
    *
    * @return ArrayCollection
    */
   public function getAssetGroups()
   {
        return $this->assetGroups;
    }

    /**
     * Add a skill from this ruleset
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

   /**
     * remove an Asset from this ruleset
     * 
     * @param RulesetAsset $asset
    *
     * @return Ruleset
     */
    public function removeAsset(RulesetAsset $asset)
    {
        $this->assets->removeElement($asset);
        
        return $this;
    }      
    
}
