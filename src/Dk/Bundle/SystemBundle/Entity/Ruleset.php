<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ruleset
 */
class Ruleset
{
    /** @var integer */
    private $id;

    /** @var Player */
    private $owner;    
    
    /** @var string */
    private $name;

    /** @var string */
    private $reference;

    /** @var ArrayCollection[RulesetCharacteristics] */
    private $characteristics;

    /** @var ArrayCollection[RulesetPlayableRace] */
    private $playableRaces;
    
    /** @var ArrayCollection[RulesetSkill] */
    private $skills;

    /** @var ArrayCollection[RulesetSkillGroup] */
    private $skillGroups;

    /** @var ArrayCollection[RulesetAsset] */
    private $assets;

    /** @var ArrayCollection[RulesetAssetGroup] */
    private $assetGroups;

    private $configs;

    public function __construct()
    {
        $this->characteristics = new ArrayCollection();
        $this->skills          = new ArrayCollection();
        $this->assets          = new ArrayCollection();
        $this->assetGroups     = new ArrayCollection();
        $this->skillGroups     = new ArrayCollection();
        $this->configs         = new ArrayCollection();
    }
    
    /**
     * Get the ruleset string representation
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
     *
     * @return Player 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set the campaign owner
     *
     * @param Player $owner
     *
     * @return $this
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
     * Get the characteristics for this ruleset
     *
     * @return ArrayCollection[RulesetCharacteristics]
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
     * @return $this
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
     * @return ArrayCollection[RulesetSkill]
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
     * @return $this
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
    * @return $this
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
    *
    * @return $this
    */
    public function removePlayableRace(RulesetPlayableRace $pr)
    {
        $this->playableRaces->removeElement($pr);
        
        return $this;
    }      
    
    /**
     * Get the playable races of this ruleset
     * 
     * @return ArrayCollection[RulesetPlayableRace]
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
     * @return $this
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
    * @return ArrayCollection[RulesetAssetGroup]
    */
   public function getAssetGroups()
   {
        return $this->assetGroups;
   }

    /**
     * Add an asset to this ruleset
     * 
     * @param RulesetAsset $asset
     *
     * @return $this
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
    * @return $this
    */
    public function removeAsset(RulesetAsset $asset)
    {
        $this->assets->removeElement($asset);
        
        return $this;
    }

    public function addConfig(Ruleset\Config $config)
    {
        $config->setRuleset($this);
        $this->configs->add($config);
    }
}
