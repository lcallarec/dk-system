<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Dk\Bundle\SystemBundle\Entity\Ruleset;

/**
 * Characteristic
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\Bundle\SystemBundle\Repository\CharacteristicRepository")
 */
class Characteristic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @var Ruleset
     * @ORM\ManyToOne(targetEntity="Ruleset", inversedBy="characteristics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruleset;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shortname", type="string", length=5)
     */
    private $shortname;

    /**
     * @var string
     *
     * @ORM\Column(name="longname", type="string", length=18)
     */
    private $longname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * Set shortname
     *
     * @param string $shortname
     * @return Characteristic
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string 
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set longname
     *
     * @param string $longname
     * @return Characteristic
     */
    public function setLongname($longname)
    {
        $this->longname = $longname;

        return $this;
    }

    /**
     * Get longname
     *
     * @return string 
     */
    public function getLongname()
    {
        return $this->longname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Characteristic
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
