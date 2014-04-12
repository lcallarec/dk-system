<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
        
        if($this->get('security.context')->isGranted('ROLE_MASTER_RULESET')) {
           $rulesets = $this->get('doctrine')
                ->getRepository('DkSystemBundle:Ruleset')
                ->findMasterRulesets($this->getUser())
           ;
        } else {
           $rulesets = null;
        }
         
        return $this->render('DkSystemBundle:Board:menu.html.twig', [
            'pcs'       => $pcs,
            'campaigns' => $campaigns,
            'rulesets'  => $rulesets
        ]);
    }

}
