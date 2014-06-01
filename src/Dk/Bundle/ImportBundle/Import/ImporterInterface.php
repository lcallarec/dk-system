<?php

namespace Dk\Bundle\ImportBundle\Import;

use Dk\Bundle\SystemBundle\Entity\Ruleset;

/**
 * Interface LoaderInterface
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
interface ImporterInterface
{
    /**
     * @param Ruleset $ruleset
     * @return Ruleset
     */
    public function import(Ruleset $ruleset);
} 