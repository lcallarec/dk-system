<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Gallery
 *
 * @package Dk\Bundle\SystemBundle\Entity
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class Gallery
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var Player */
    private $owner;

    /** @var ArrayCollection */
    private $images;

    /** @var array */
    private $privacies;

    /** @var string */
    private $path;

    /** @var Gallery */
    private $parent;

    /** @var Gallery */
    private $children;

    /** @var int */
    private $level;

   /**
    * @param Player $owner
    */
    public function __construct(Player $owner)
    {
        $this->owner     = $owner;
        $this->images    = new ArrayCollection();
        $this->privacies = [];

    }
    
    /**
     * Get the string representation of this gallery
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Campaign
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the campaign owner
     *
     * @return Player 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set the campaign owner
     *
     * @param Player $owner
     *
     * @return Campaign
     */
    public function setOwner(Player $owner)
    {
        $this->owner = $owner;
        
        return $this;
    }

    /**
     * @return array
     */
    public function getPrivacies()
    {
        return $this->privacies;
    }

    /**
     * @param array $privacies
     *
     * @return $this
     */
    public function setPrivacies(array $privacies = [])
    {
        $this->privacies = $privacies;

        return $this;
    }

    /**
     * @param Gallery $parent
     *
     * @return $this
     */
    public function setParent(Gallery $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Gallery
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return Gallery
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param $path
     *
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param $level
     *
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }
}
