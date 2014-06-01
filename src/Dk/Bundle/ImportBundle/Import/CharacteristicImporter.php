<?php

namespace Dk\Bundle\ImportBundle\Import;

use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Dk\Bundle\SystemBundle\Entity\RulesetCharacteristic;

/**
 * Class CharacteristicImporter
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class CharacteristicImporter extends Importer
{
    /** @var string */
    protected static $namespace = 'characteristics';

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
                ->setLongname($this->getValue(sprintf('[%s][longname]', $shortName, $i)))
                ->setDescription($this->getValue(sprintf('[%s][desc]', $shortName, $i)))
            ;

            $ruleset->addCharacteristic($char);
        }

        return $ruleset;
    }

} 