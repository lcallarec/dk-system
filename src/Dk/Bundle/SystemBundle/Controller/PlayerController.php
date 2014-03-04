<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Form\PlayerType;

class PlayerController extends Controller
{
    /**
     */
    public function showAllAction()
    {
        $players = $this->get('doctrine')->getRepository('DkSystemBundle:Player')->findWithCharacters();
  
        return $this->render('DkSystemBundle:Player:all.html.twig', ['players' => $players]);
    }
    
   /**
    */
    public function manageAction($id)
    {
        $request = $this->getRequest();
        
        if(null !== $id) {
            $player = $this->get('doctrine')->getRepository('DkSystemBundle:Player')->findOneById($id);
        
            if(!$player) {
                $this->createNotFoundException("Ce joueur n'existe pas");
            }
        } else {
            $player = new Player();
        }
        
        $form = $this->createForm(new PlayerType(), $player);
        
        if($request->getMethod() === 'GET') {
            
            return $this->render('DkSystemBundle:Player:form.html.twig', ['form' => $form->createView()]);
         
        } else {
             
            $form->handleRequest($request);
            
            if($form->isValid()) {
                
                $em = $this->get('doctrine')->getManager();
                
                $em->persist($player);
                
                $em->flush();
                
                return $this->forward('DkSystemBundle:Player:showAll');
                
            } else {
                
                return $this->render('DkSystemBundle:Player:form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
}
