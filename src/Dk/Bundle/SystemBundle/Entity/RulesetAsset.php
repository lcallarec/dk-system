<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetAsset
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\Bundle\SystemBundle\Repository\RulesetAssetRepository")
 */
class RulesetAsset
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
     * @ORM\ManyToOne(targetEntity="Ruleset", inversedBy="assets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruleset;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="use_limitation", type="string", length=16, nullable=true)
     */
    private $useLimitation;

    /**
     * @var string
     *
     * @ORM\Column(name="use_cost", type="string", length=16, nullable=true)
     */
    private $useCost;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="pre_requisite", type="string", length=255, nullable=true)
     */
    private $preRequisite;

    /**
     * @var RulesetAssetGroup
     *
     * @ORM\ManyToOne(targetEntity="RulesetAssetGroup", inversedBy="assets")
     * @ORM\JoinColumn(nullable=true)
     */
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
     * @return RulesetAsset
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
     * @return RulesetAsset
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
     * @return RulesetAsset
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
     * @return RulesetAsset
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
     * @return RulesetAsset
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
        $this->group = $group;

        return $this;
    }
}
