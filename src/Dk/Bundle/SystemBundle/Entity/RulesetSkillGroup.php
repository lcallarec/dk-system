<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RulesetAssetGroup
 *
 * @Gedmo\Tree(type="materializedPath")
 */
class RulesetSkillGroup
{
    /**
     * @var integer
     *
     * @Gedmo\TreePathSource
     */
    private $id;

    /**
     * @Gedmo\TreePath(separator=".", startsWithSeparator=false, endsWithSeparator=false)
     */
    private $path;

    /**
     */
    private $name;

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
     */
    private $ruleset;

    /**
     * @ORM\OneToMany(targetEntity="RulesetSkill", mappedBy="group")
     */
    private $skills;

    public function getId()
    {
        return $this->id;
    }

    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    public function getSkills()
    {
        return $this->skills;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setParent(RulesetSkillGroup $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getChildren()
    {
        return $this->children;
    }


    public function setPath($path)
    {
        $this->path = $path;

        return $this;
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
     * Get the ruleset
     *
     * @return \Dk\Bundle\SystemBundle\Entity\Ruleset $ruleset
     */
    public function getRuleset()
    {
        return $this->ruleset;
    }

    /**
     * Set the ruleset
     *
     * @param \Dk\Bundle\SystemBundle\Entity\Ruleset $ruleset
     * @return \Dk\Bundle\SystemBundle\Entity\RulesetSkillGroup
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;

        return $this;
    }
}
