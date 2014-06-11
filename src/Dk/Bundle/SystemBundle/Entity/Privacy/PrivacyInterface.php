<?php

namespace Dk\Bundle\SystemBundle\Entity\Privacy;

/**
 * Interface PrivacyInterface
 *
 * @package Dk\Bundle\SystemBundle\Entity\Privacy
 */
interface PrivacyInterface
{
    /** @const int */
    const TYPE_PRIVATE = 0;

    /** @const int */
    const TYPE_PUBLIC = 2;

    /**
     * Get the privacy type
     * @return int
     */
    public function getType();
}