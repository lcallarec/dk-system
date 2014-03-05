<?php
namespace Dk\Bundle\SystemBundle\Factory;

use Dk\Bundle\SystemBundle\Entity\Campaign;
use Dk\Bundle\SystemBundle\Entity\Player;

/**
 * Create player character (via service container)
 *
 * @author laurent
 */
class CampaignFactory
{
    /**
     *
     * @var Player 
     */
    private $owner;
    
    /**
     * 
     * @param Player $pc
     */
    public function __construct(Player $owner)
    {
        $this->owner = $owner;
    }
    
    public function create()
    {
        return new Campaign($this->owner);
    }
}
