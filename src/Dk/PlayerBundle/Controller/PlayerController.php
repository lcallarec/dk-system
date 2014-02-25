<?php

namespace Dk\PlayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\PlayerBundle\Entity\Player;
use Dk\PlayerBundle\Form\PlayerType;

class PlayerController extends Controller
{
    /**
     */
    public function showAllAction()
    {
        $players = $this->get('doctrine')->getRepository('DkPlayerBundle:Player')->findAll();
        
        return $this->render('DkPlayerBundle:Player:all.html.twig', ['players' => $players]);
    }
    
   /**
    */
    public function manageAction($id)
    {
        $request = $this->getRequest();
        
        if(null !== $id) {
            $player = $this->get('doctrine')->getRepository('DkPlayerBundle:Player')->findOneById($id);
        
            if(!$player) {
                $this->createNotFoundException("Ce joueur n'existe pas");
            }
        } else {
            $player = new Player();
        }
        
        $form = $this->createForm(new PlayerType(), $player);
        
        if($request->getMethod() === 'GET') {
            
            return $this->render('DkPlayerBundle:Player:form.html.twig', ['form' => $form->createView()]);
         
        } else {
             
            $form->handleRequest($request);
            
            if($form->isValid()) {
                
                $em = $this->get('doctrine')->getManager();
                
                $em->persist($player);
                
                $em->flush();
                
                return $this->render('DkPlayerBundle:Player:all.html.twig');
                
            } else {
                
                return $this->render('DkPlayerBundle:Player:form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
}
