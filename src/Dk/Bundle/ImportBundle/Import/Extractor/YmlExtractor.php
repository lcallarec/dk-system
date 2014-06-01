<?php

namespace Dk\Bundle\ImportBundle\Import\Extractor;

use Symfony\Component\Yaml\Parser;

/**
 * Class YmlExtractor
 *
 * @package Dk\Bundle\ImportBundle\Import\Extractor
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class YmlExtractor implements DataExtractorInterface
{
    /** @var Parser */
    private $parser;

    /**
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * {@inheritDoc}
     */
    public function extract($content)
    {
        return $this->parser->parse($content);
    }
} 