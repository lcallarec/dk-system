<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RulesetAssetGroup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\MaterializedPathRepository")
 * @Gedmo\Tree(type="materializedPath")
 */
class RulesetAssetGroup
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Gedmo\TreePathSource
     */
    private $id;

    /**
     * @Gedmo\TreePath(separator=".", startsWithSeparator=false, endsWithSeparator=false)
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="RulesetAssetGroup", inversedBy="children")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $parent;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer", nullable=true)
     */
    private $level;

    /**
     * @ORM\OneToMany(targetEntity="RulesetAssetGroup", mappedBy="parent")
     */
    private $children;

    /**
     *
     * @var Ruleset
     *
     * @ORM\ManyToOne(targetEntity="Ruleset", inversedBy="assetGroups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruleset;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="RulesetAsset", mappedBy="group")
     */
    private $assets;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128)
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
     * @return integer
     */
    public function getParent()
    {
        return (int) $this->parent;
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
