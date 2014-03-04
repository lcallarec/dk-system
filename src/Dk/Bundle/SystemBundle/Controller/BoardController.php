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
         $pcs = $this->get('doctrine')
                ->getRepository('DkSystemBundle:PlayerCharacter')
                ->findPlayerCharacters($this->getUser())
        ;
         
        return $this->render('DkSystemBundle:Panel:menu.html.twig', ['pcs' => $pcs]);
    }

}
