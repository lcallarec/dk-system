<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;

/**
 * Campaign
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\Bundle\SystemBundle\Repository\CampaignRepository")
 */
class Campaign
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     *
     * The campaign ruleset
     * @var Ruleset
     * @ORM\ManyToOne(targetEntity="Ruleset")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ruleset;
    
    /**
     * The player owning this campaign
     * @var Player 
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;
    
    /**
     * ArrayCollection of PlayerCharacters
     * @var ArrayCollection  
     * 
     * @ORM\OneToMany(targetEntity="Dk\Bundle\SystemBundle\Entity\PlayerCharacter", mappedBy="campaign", cascade={"all"})
     */
    private $playerCharacters;
    
    /**
     * A campaign owner is mandatory
     * 
     * @param Player $owner
     */
    public function __construct(Player $owner)
    {
        $this->owner = $owner;
        
        $this->playerCharacters = new ArrayCollection();
    }
    
   /**
     * Get the string representation of this campaign
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
     * Get a collection of player characters playing in this campaign
     * @return ArrayCollection
     */
    public function getPlayerCharacters()
    {
        return $this->playerCharacters;
    }
    
    /**
     * Add a player character to this campaign
     * 
     * @param \Dk\Bundle\SystemBundle\Entity\PlayerCharacter $playerCaracter
     * @return \Dk\Bundle\SystemBundle\Entity\Campaign
     */
    public function addPlayerCharacter(PlayerCharacter $playerCharacter)
    {
        $playerCharacter->setCampaign($this);

        $this->playerCharacters->add($playerCharacter);
        
        return $this;
    }
    
    /**
     * Remove a player character from this campaign
     * 
     * @param \Dk\Bundle\SystemBundle\Entity\PlayerCharacter $playerCharacter
     * @return \Dk\Bundle\SystemBundle\Entity\Campaign
     */
    public function removePlayerCharacter(PlayerCharacter $playerCharacter)
    {
       $playerCharacter->setCampaign(null);
       
       $this->playerCharacters->removeElement($playerCharacter);
       
       return $this;
    }
    
    /**
     * Get the campaign owner
     * @return Player 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set the campaign owner
     * @param Player $owner
     * @return Campaign
     */
    public function setOwner(Player $owner)
    {
        $this->owner = $owner;
        
        return $this;
    }
    
   /**
     * Get the campaign ruleset
     * @return Ruleset 
     */
    public function getRuleset()
    {
        return $this->ruleset;
    }
    
    /**
     * Set the campaign ruleset
     * @param ruleset $ruleset
     * @return Campaign
     */
    public function setRuleset(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
        
        return $this;
    }
}
