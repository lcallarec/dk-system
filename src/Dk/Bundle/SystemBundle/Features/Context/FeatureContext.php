<?php

namespace Dk\Bundle\SystemBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Symfony2Extension\Context\KernelDictionary;

class FeatureContext implements Context, SnippetAcceptingContext
{
    use KernelDictionary;

    /**
     * @BeforeScenario
     */
    public function setupScenario($event)
    {
        $this->getKernel()->boot();
    }
}
