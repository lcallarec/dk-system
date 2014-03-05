<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BoardController extends Controller
{
    /**
     */
    public function indexAction()
    {
        return $this->render('DkSystemBundle::board.html.twig');
    }
    
    /**
     * Render the menu panel
     * @return Response
     */
    public function menuAction()
    {
        if($this->get('security.context')->isGranted('ROLE_PLAYER')) {
            $pcs = $this->get('doctrine')
                ->getRepository('DkSystemBundle:PlayerCharacter')
                ->findPlayerCharacters($this->getUser())
            ;  
        } else {
            $pcs = null;
        }
        
        if($this->get('security.context')->isGranted('ROLE_MASTER')) {
           $campaigns = $this->get('doctrine')
                ->getRepository('DkSystemBundle:Campaign')
                ->findMasterCampaigns($this->getUser())
            ;  
        } else {
           $campaigns = null;
        }
         
         
        return $this->render('DkSystemBundle:Board:menu.html.twig', ['pcs' => $pcs, 'campaigns' => $campaigns]);
    }

}
