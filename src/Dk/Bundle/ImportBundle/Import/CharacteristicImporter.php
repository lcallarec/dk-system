<?php

namespace Dk\Bundle\ImportBundle\Import;

use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Dk\Bundle\SystemBundle\Entity\RulesetCharacteristic;

/**
 * Class CharacteristictImporter
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class CharacteristictImporter extends Importer
{
    /**
     * Import characteristics for the given ruleset
     *
     * @param Ruleset $ruleset
     * @return Ruleset
     */
    public function import(Ruleset $ruleset)
    {
        $i = 0;
        foreach ($this->data as $shortName => $definition) {

            $char = new RulesetCharacteristic();

            $char
                ->setShortname($shortName)
                ->setLongname($this->getValue(sprintf('[%d].[%s]', $i, $definition['longname'])))
                ->setDescription($this->getValue(sprintf('[%d].[%s]', $i, $definition['desc'])))
                ->setRuleset($ruleset)
            ;
        }

        return $ruleset;
    }

} 