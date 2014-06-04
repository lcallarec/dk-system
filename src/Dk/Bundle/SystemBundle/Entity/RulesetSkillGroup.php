<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * RulesetAssetGroup
 */
class RulesetSkillGroup
{
    /** @var int */
    private $id;

    /** @var string */
    private $path;

    /** @var string */
    private $name;

    /** @var RulesetSkillGroup */
    private $parent;

    /** @var int */
    private $level;

    /** @var RulesetSkillGroup */
    private $children;

    /** @var Ruleset */
    private $ruleset;

    /** @var ArrayCollection[RulesetSkill] */
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
     * @return Ruleset $ruleset
     */
    public function getRuleset()
    {
        return $this->ruleset;
    }

    /**
     * Set the ruleset
     *
     * @param Ruleset $ruleset
     *
     * @return RulesetSkillGroup
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;

        return $this;
    }
}
