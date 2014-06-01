<?php

namespace Dk\Bundle\ImportBundle\Import;

use Closure;
use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Dk\Bundle\SystemBundle\Entity\RulesetSkill;
use Dk\Bundle\SystemBundle\Entity\RulesetSkillGroup;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class SkillImporter
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class SkillImporter extends Importer
{
    /** @var string */
    protected static $namespace = 'skills';

    /**
     * Import characteristics for the given ruleset
     *
     * @param Ruleset $ruleset
     * @return Ruleset
     */
    public function import(Ruleset $ruleset)
    {
        $groups = new ArrayCollection();

        $this->recursiveItemManager(
            $this->data,
            null,
            $this->getGroupClosure($ruleset, $groups, new RulesetSkillGroup()),
            $this->getSkillClosure($ruleset, $groups)
        );
    }

    /**
     * @param Ruleset         $ruleset
     * @param ArrayCollection $groups
     *
     * @return Closure
     */
    protected function getSkillClosure(Ruleset $ruleset, ArrayCollection $groups)
    {
        return function($name, $data, $group) use ($groups, $ruleset) {

            $skill = new RulesetSkill();
            $skill
                ->setName($name)
                ->setOverloadMalus(isset($data['malus'])? true : false)
                ->setChar1($ruleset->getCharacteristics()->get(strtolower($data['chars'][0])))
                ->setChar2($ruleset->getCharacteristics()->get(strtolower($data['chars'][1])))
                ->setDescription($data['desc'])
            ;

            if (!$groups->isEmpty()) {
                $skill->setGroup($groups->get($group));
            }

            $ruleset->addSkill($skill);
        };
    }

} 