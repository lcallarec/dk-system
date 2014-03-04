<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\PlayerCharacterType;

class CharacterController extends Controller
{
   
   /**
    * Manage Characters
    */
    public function manageAction($id)
    {
        $request = $this->getRequest();
        
        if(null !== $id) {
            $pc = $this->get('doctrine')->getRepository('DkSystemBundle:PlayerCharacter')->findOneById($id);
        
            if(!$pc) {
                $this->createNotFoundException("Ce personnage n'existe pas");
            }
        } else {
            $pc = $this->get('dk_pc_factory')->create();
        }
        
        $form = $this->createForm(new PlayerCharacterType(), $pc);
        
        if($request->getMethod() === 'GET') {
            
            return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', ['form' => $form->createView()]);
         
        } else {
             
            $form->handleRequest($request);
            
            if($form->isValid()) {
                
                $em = $this->get('doctrine')->getManager();
                
                $em->persist($pc);
                
                $em->flush();
                
                return $this->forward('DkSystemBundle:Board:index');
                
            } else {
                
                return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
}
