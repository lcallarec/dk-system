<?php

namespace Dk\PlayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Dk\CharacterBundle\Entity\PlayerCharacter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\PlayerBundle\Repository\PlayerRepository")
 */
class Player implements UserInterface, \Serializable
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
     * @ORM\Column(name="nickname", type="string", length=50)
     * @Assert\NotBlank(message="Le nickname ne doit pas être vide")
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Votre nickname doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre nickname ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;
    
    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;    
    
    /**
     *
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Dk\CharacterBundle\Entity\PlayerCharacter", mappedBy="player", cascade={"all"})
     */
    private $characters;
    
    public function __construct()
    {
        $this->characters = new ArrayCollection();
        
        $this->salt = md5(uniqid(null, true));
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
     * Set nickname
     *
     * @param string $nickname
     * @return Player
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }
    
    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->nickname;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
    
    /**
     * Get all characters owned by this player
     * 
     * @return ArrayCollection
     */
    public function getCharacters()
    {
        return $this->characters;
    }
    
    
    /**
     * Add a character to the collection
     * 
     * @param PlayerCharacter $character
     * @return Player
     */
    public function addCharacter(PlayerCharacter $character)
    {
        $character->setPlayer($this);
        
        $this->characters->add($character);
        
        return $this;
    }
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }
    
    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }
}
