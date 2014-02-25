<?php

namespace Dk\CharacterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Dk\PlayerBundle\Entity\Player;

/**
 * PlayerCharacter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\CharacterBundle\Repository\PlayerCharacterRepository")
 */
class PlayerCharacter
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
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Dk\PlayerBundle\Entity\Player", inversedBy="characters", cascade={"all"})
     */
    private $player;
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;


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
     * Set firstname
     *
     * @param string $firstname
     * @return PlayerCharacter
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return PlayerCharacter
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     * Get the player who own this character
     * 
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }
    
    /**
     * Associate a player to this character
     * 
     * @param \Dk\PlayerBundle\Entity\Player $player
     * @return \Dk\CharacterBundle\Entity\PlayerCharacter
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
        
        return $this;
    }
}
