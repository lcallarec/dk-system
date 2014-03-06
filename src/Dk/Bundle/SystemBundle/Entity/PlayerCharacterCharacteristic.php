<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;

/**
 * PlayerCharacterCharacteristic
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PlayerCharacterCharacteristic
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
     * @var PlayerCharacter
     * @ORM\ManyToOne(targetEntity="PlayerCharacter", inversedBy="characteristics") 
     */
    private $playerCharacter;

    /**
     *
     * @var Characteristic
     * @ORM\ManyToOne(targetEntity="Characteristic") 
     */
    private $characteristic;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="smallint")
     */
    private $value;


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
     * Set value
     *
     * @param integer $value
     * @return PlayerCharacterCharacteristic
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Get the related Characteristic
     * @return Characteristic
     */
    public function getCharacteristic()
    {
        return $this->characteristic;
    }
    
    /**
     * Set the Charactristic on which this Char rely on
     * @param Characteristic $char
     * @return \PlayerCharacterCharacteristic
     */
    public function setCharacteristic(Characteristic $char = null)
    {
        if(null !== $char) {
            $this->characteristic = $char;
        }
   
        return $this;
    }
    
    public function setPlayerCharacter(PlayerCharacter $pc)
    {
        $this->playerCharacter = $pc;
    }
}
