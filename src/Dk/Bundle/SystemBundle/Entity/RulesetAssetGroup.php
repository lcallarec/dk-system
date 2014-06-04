<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RulesetAssetGroup
 */
class RulesetAssetGroup
{
    /** @var int */
    private $id;

    /** @var string */
    private $path;

    /** @var RulesetAssetGroup */
    private $parent;

    /** @var int */
    private $level;

    /** @var RulesetAssetGroup */
    private $children;

    /** @var Ruleset */
    private $ruleset;

    /** @var ArrayCollection[RulesetAsset] */
    private $assets;

    /** @var string */
    private $name;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
    }

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
     *
     */
    public function getId()
    {
        return (int) $this->id;
    }

    /**
     * Get the parent group
     *
     * @return RulesetAssetGroup
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent group
     *
     * @param RulesetAssetGroup $parent
     *
     * @return $this
     */
    public function setParent(RulesetAssetGroup $parent)
    {
        $this->parent = $parent;

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
     * @return ArrayCollection[RulesetAsset]
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @param ArrayCollection $assets
     */
    public function setAssets(ArrayCollection $assets)
    {
        $this->assets = $assets;
    }

    /**
     * @param RulesetAsset $asset
     *
     * @return $this
     */
    public function addAsset(RulesetAsset $asset)
    {
        $this->assets->add($asset);

        return $this;
    }

    /**
     * @param RulesetAsset $asset
     *
     * @return $this
     */
    public function removeAsset(RulesetAsset $asset)
    {
        if ($this->assets->contains($asset)) {
            $this->assets->removeElement($asset);
        }

        return $this;
    }

    /**
     * @return RulesetAssetGroup
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param string
     *
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the ruleset
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
