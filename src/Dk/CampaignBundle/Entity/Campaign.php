<?php

namespace Dk\CampaignBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Dk\CharacterBundle\Entity\PlayerCharacter;

/**
 * Campaign
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\CampaignBundle\Repository\CampaignRepository")
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
     * ArrayCollection of PlayerCharacters
     * @var ArrayCollection  
     * 
     * @ORM\OneToMany(targetEntity="Dk\CharacterBundle\Entity\PlayerCharacter", mappedBy="campaign")
     */
    private $playerCharacters;
    
    public function __construct()
    {
        $this->playerCharacters = new ArrayCollection();
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
     * @param \Dk\CharacterBundle\Entity\PlayerCharacter $playerCaracters
     * @return \Dk\CampaignBundle\Entity\Campaign
     */
    public function addPlayerCharacter(PlayerCharacter $playerCaracters)
    {
        $playerCaracters->setCampaign($this);
        
        $this->playerCharacters->add($playerCaracters);
        
        return $this;
    }
    
    
}
