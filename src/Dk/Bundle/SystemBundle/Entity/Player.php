<?php

namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Player
 *
 * @package Dk\Bundle\SystemBundle\Entity
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class Player implements UserInterface, \Serializable
{
    /** @var integer */
    private $id;

    /** @var string */
    private $nickname;

    /** @var array */
    private $roles;
    
    /** @var string */
    private $email;

    /** @var string */
    private $salt;
    
    /** @var string */
    private $password;    
    
    /** @var ArrayCollection[PlayerCharacter] */
    private $characters;
    
    public function __construct()
    {
        $this->characters = new ArrayCollection();
        
        $this->salt = md5(uniqid(null, true));
    }
    
    /**
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getNickname();
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
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }
    
    /**
     * Set nickname
     *
     * @param string $nickname
     *
     * @return Player
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set email
     *
     * @param string $email
     *
     * @return Player
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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
        return $this->roles;
    }

    /**
     * @inheritDoc
     */
    public function setRoles($roles = [])
    {
        if(!is_array($roles) && $roles) {
            $roles = [$roles];
        }
        
        $this->roles = $roles;
        
        return $this;
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
        return serialize([
            $this->id
        ]);
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
