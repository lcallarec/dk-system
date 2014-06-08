<?php

namespace Dk\Bundle\ImportBundle\Import;

use Closure;
use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Dk\Bundle\SystemBundle\Entity\RulesetAsset;
use Dk\Bundle\SystemBundle\Entity\RulesetAssetGroup;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class SkillImporter
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class AssetImporter extends Importer
{
    /** @var string */
    protected static $namespace = 'assets';

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
            $this->getGroupClosure($ruleset, $groups, new RulesetAssetGroup()),
            $this->getAssetClosure($ruleset, $groups)
        );

    }

    /**
     * @param Ruleset         $ruleset
     * @param ArrayCollection $groups
     *
     * @return Closure
     */
    protected function getAssetClosure(Ruleset $ruleset, ArrayCollection $groups)
    {
        return function($name, $data, $group) use ($groups, $ruleset) {

            if(false === isset($data['desc'])) {
                $description = $data;
            } else {
                $description = $data['desc'];
            }

            $asset = new RulesetAsset();
            $asset
                ->setName($name)
                ->setDescription($description)
                ->setRuleset($ruleset)
            ;

            if (!$groups->isEmpty()) {
                $asset->setGroup($groups->get($group));
            }

            $ruleset->addAsset($asset);

        };
    }

} 