<?php

namespace Dk\Bundle\ImportBundle\Import;

use Dk\Bundle\SystemBundle\Entity\Ruleset;

/**
 * Class RulesetImporter
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class RulesetImporter extends Importer
{
    /** @var string */
    protected static $namespace = 'ruleset';

    /**
     * Hydrate a Ruleset empty object
     *
     * @param Ruleset   $ruleset
     * @return Ruleset
     */
    public function import(Ruleset $ruleset)
    {
         $ruleset
            ->setName($this->getValue('[core][name]'))
            ->setReference($this->getValue('[core][reference]'))
         ;

         foreach ($this->getValue('[config][asset]') as $hash => $values) {
             foreach ($values as $key => $value) {
                 $config = (new Ruleset\AssetConfig())->setHash(sprintf('%s:%d', $hash, $key))->setValue($value);
                 $config->setRuleset($ruleset);
             }
         }

         return $ruleset;
    }
}