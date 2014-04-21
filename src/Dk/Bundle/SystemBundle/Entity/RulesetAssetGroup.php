<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * RulesetAssetGroup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\Bundle\SystemBundle\Repository\RulesetAssetGroupRepository")
 */
class RulesetAssetGroup
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
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parent;

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
     * @param $parent
     *
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = (int) $parent;

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
}
