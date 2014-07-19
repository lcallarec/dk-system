<?php

namespace Dk\Bundle\SystemBundle\Entity\Ruleset;

use Dk\Bundle\SystemBundle\Entity\Ruleset;

/**
 * Class Config
 *
 * @package Dk\Bundle\SystemBundle\Entity\Ruleset
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class AssetConfig
{
    /** @var integer */
    protected $id;

    protected $hash;

    /** @var string */
    protected $value;

    /** @var Ruleset */
    protected $ruleset;

    /** @var string */
    protected $type;

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set hash
     *
     * @param string $hash
     *
     * @return Config
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Config
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the config ruleset
     *
     * @return Ruleset
     */
    public function getRuleset()
    {
        return $this->ruleset;
    }

    /**
     * Set the config ruleset
     *
     * @param Ruleset $ruleset
     *
     * @return Config
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;

        return $this;
    }
}
