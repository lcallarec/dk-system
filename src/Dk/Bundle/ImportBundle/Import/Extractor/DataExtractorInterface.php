<?php

namespace Dk\Bundle\ImportBundle\Import\Extractor;

/**
 * Interface DataExtractorInterface
 *
 * @package Dk\Bundle\ImportBundle\Import\Extractor
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
interface DataExtractorInterface
{
    /**
     * Extract a content and return data in array format
     *
     * @param string $content
     *
     * @return array
     */
    public function extract($content);
} 