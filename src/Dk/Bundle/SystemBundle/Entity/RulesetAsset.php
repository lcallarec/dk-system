<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetAsset
 */
class RulesetAsset
{
    /** @var int */
    private $id;

    /** @var Ruleset */
    private $ruleset;    
    
    /** @var string */
    private $name;

    /** @var string */
    private $useLimitation;

    /** @var string */
    private $useCost;

    /** @var string */
    private $description;

    /** @var string */
    private $preRequisite;

    /** @var RulesetAssetGroup */
    private $group;


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
    
    /**
     * Get id
     *
     * @return int
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
     * Set useLimitation
     *
     * @param string $useLimitation
     *
     * @return $this
     */
    public function setUseLimitation($useLimitation)
    {
        $this->useLimitation = $useLimitation;

        return $this;
    }

    /**
     * Get useLimitation
     *
     * @return string 
     */
    public function getUseLimitation()
    {
        return $this->useLimitation;
    }

    /**
     * Set useCost
     *
     * @param string $useCost
     *
     * @return $this
     */
    public function setUseCost($useCost)
    {
        $this->useCost = $useCost;

        return $this;
    }

    /**
     * Get useCost
     *
     * @return string 
     */
    public function getUseCost()
    {
        return $this->useCost;
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
     * Set preRequisite
     *
     * @param string $preRequisite
     *
     * @return $this
     */
    public function setPreRequisite($preRequisite)
    {
        $this->preRequisite = $preRequisite;

        return $this;
    }

    /**
     * Get preRequisite
     *
     * @return string 
     */
    public function getPreRequisite()
    {
        return $this->preRequisite;
    }

    /**
     * Get the Ruleset
     *
     * @return $this
     */
    public function getRuleset()
    {
        return $this->ruleset;
    }

    /**
     * Set the RulesetAsset ruleset
     * 
     * @param Ruleset $ruleset
     *
     * @return RulesetAsset
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
        
        return $this;
    }

    /**
     * Get related asset group
     *
     * @return RulesetAssetGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set the related asset group
     *
     * @param RulesetAssetGroup $group
     *
     * @return $this
     */
    public function setGroup(RulesetAssetGroup $group)
    {
        $group->addAsset($this);

        $this->group = $group;

        return $this;
    }
}
