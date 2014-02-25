<?php

namespace Dk\PlayerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Player
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Dk\PlayerBundle\Repository\PlayerRepository")
 */
class Player
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
}
