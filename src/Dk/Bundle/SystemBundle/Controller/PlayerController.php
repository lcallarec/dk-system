<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Player\PlayerType;

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
    * Manage account for current user:
    */
    public function manageAction()
    {
        $request = $this->getRequest();
        
        $player = $this->getUser();
        
        $form = $this->createForm(new PlayerType(), $player);
        
        if($request->getMethod() === 'GET') {
            
            return $this->render('DkSystemBundle:Player:account.html.twig', ['form' => $form->createView()]);
         
        } else {
             
            $form->handleRequest($request);
            
            if($form->isValid()) {
                
                $em = $this->get('doctrine')->getManager();
                
                $em->persist($player);
                
                $em->flush();
                
                return $this->forward('DkSystemBundle:Board:index');
                
            } else {
                
                return $this->render('DkSystemBundle:Player:account.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
}
