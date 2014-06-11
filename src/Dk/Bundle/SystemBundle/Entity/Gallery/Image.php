<?php

namespace Dk\Bundle\SystemBundle\Entity\Gallery;

use Dk\Bundle\SystemBundle\Entity\Gallery;

/**
 * Class Image
 *
 * @package Dk\Bundle\SystemBundle\Entity\Gallery
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class Image
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var Gallery */
    private $gallery;
    
    /**
     * Get the string representation of this image
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set gallery
     *
     * @param Gallery $gallery
     *
     * @return $this
     */
    public function setGallery($gallery)
    {
        $this->gallery = $gallery;

        return $this;
    }
}
