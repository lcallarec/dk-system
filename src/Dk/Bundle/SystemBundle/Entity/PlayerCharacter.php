<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PlayerCharacter
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\Bundle\SystemBundle\Repository\PlayerCharacterRepository")
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
     * @ORM\ManyToOne(targetEntity="Dk\Bundle\SystemBundle\Entity\Player", inversedBy="characters")
     */
    private $player;
    
    /**
     * @var Campaign
     * @ORM\ManyToOne(targetEntity="Dk\Bundle\SystemBundle\Entity\Campaign", inversedBy="playerCharacters", cascade={"persist"})
     */
    private $campaign;
    
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     * @Assert\NotBlank(message="Le prénom du personnage est obligatoire")
     * @Assert\Length(
     *      min = "1",
     *      max = "255",
     *      minMessage = "Le prénom du personnage doit être composé d'au moins {{ limit }} caractères",
     *      maxMessage = "Le prénom du personnage ne peut dépasser {{ limit }} caractères"
     * )* 
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     *
     * @var ArrayCollection of PlayerCharacterCharacteristics
     * @ORM\OneToMany(targetEntity="PlayerCharacterCharacteristic", mappedBy="playerCharacter", cascade={"all"})
     */
    private $characteristics;
    
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="PlayerCharacterSkill", mappedBy="playerCharacter", cascade={"all"})
     */
    private $skills;
    
    /**
     *
     * @var RulesetPlayableRace
     * @ORM\ManyToOne(targetEntity="RulesetPlayableRace") 
     */
    private $race;
    
    public function __construct(Player $player)
    {
        $this->setPlayer($player);
        
        $this->characteristics = new ArrayCollection();
        $this->skills          = new ArrayCollection();
    }

    /**
     * Get the string representation of a PlayerCharacter object
     * @return string
     */
    public function __toString()
    {
        $s = $this->firstname;
        
        if($this->lastname) {
            $s .= sprintf(' %s', $this->lastname);
        }
        
        return $s;
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
     * Get the campaign where this caracter is playing
     * 
     * @return Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }
    
    /**
     * Set the campaign where this caracter is playing 
     * @param \Dk\Bundle\SystemBundle\Entity\Campaign $campaign
     * @return self
     */
    public function setCampaign(Campaign $campaign = null)
    {
        $this->campaign = $campaign;
        
        return $this;
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
     * @param \Dk\Bundle\SystemBundle\Entity\Player $player
     * @return \Dk\Bundle\SystemBundle\Entity\PlayerCharacter
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
        
        return $this;
    }
    
    /**
     * Get characteristics
     * 
     * @return ArrayCollection
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }
    
    public function addCharacteristic(PlayerCharacterCharacteristic $char)
    {
        $char->setPlayerCharacter($this);
        $this->characteristics->add($char);
    }
    
    /**
     * Get skills
     * 
     * @return ArrayCollection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * 
     * @param \Dk\Bundle\SystemBundle\Entity\PlayerCharacterSkill $skill
     * @return \Dk\Bundle\SystemBundle\Entity\PlayerCharacter
     */
    public function addSkill(PlayerCharacterSkill $skill)
    {
        $skill->setPlayerCharacter($this);
        $this->skills->add($skill);
        
        return $this;
    }
    
    /**
     * Get the character race
     * 
     * @return ArrayCollection
     */
    public function getRace()
    {
        return $this->race;
    }
    
    /**
     * 
     * @param \Dk\Bundle\SystemBundle\Entity\RulesetPlayableRace $race
     * @return \Dk\Bundle\SystemBundle\Entity\PlayerCharacter
     */
    public function setRace(RulesetPlayableRace $race)
    {
        $this->$race = $race;
        
        return $this;
    }

}
