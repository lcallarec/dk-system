<?php
namespace Dk\Bundle\SystemBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\Bundle\SystemBundle\Repository\PlayerRepository")
 * @UniqueEntity(fields="email", message="Cet email existe déjà")
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
     *
     * @var array
     * @ORM\Column(name="role", type="array")
     * @Assert\NotBlank(message="Le type de compte doit être spéicifé")
     */
    private $roles;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Cet email est invalide", checkMX=true)
     */
    private $email;    
    
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
     * @ORM\OneToMany(targetEntity="Dk\Bundle\SystemBundle\Entity\PlayerCharacter", mappedBy="player", cascade={"all"})
     */
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
