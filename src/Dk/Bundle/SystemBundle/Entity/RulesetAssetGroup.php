<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RulesetAssetGroup
 *
 * @Gedmo\Tree(type="materializedPath")
 */
class RulesetAssetGroup
{
    /**
     * @var integer
     * @Gedmo\TreePathSource
     */
    private $id;

    /**
     * @Gedmo\TreePath(separator=".", startsWithSeparator=false, endsWithSeparator=false)
     */
    private $path;

    /**
     * @Gedmo\TreeParent
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $parent;

    /**
     * @Gedmo\TreeLevel
     */
    private $level;

    /**
     */
    private $children;

    /**
     *
     * @var Ruleset
     *
     */
    private $ruleset;

    /**
     * @var ArrayCollection
     *
     */
    private $assets;

    /**
     * @var string
     */
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
     * @return integer 
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
     * @return RulesetAsset
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
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

    public function getChildren()
    {
        return $this->children;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getLevel()
    {
        return $this->level;
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
