<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dk\Bundle\SystemBundle\Form\PlayerCharacterType;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacterCharacteristic;

class CharacterController extends Controller
{
   
   /**
    * Manage Characters
    */
    public function manageAction($id)
    {
        $request = $this->getRequest();
        
        if(null !== $id) {
            $pc = $this->get('doctrine')->getRepository('DkSystemBundle:PlayerCharacter')->findOneWithRelationships($this->getUser(), $id);

            if(null === $pc) {
                $this->createNotFoundException("Ce personnage n'existe pas");
            }
            
        } else {
            $pc = $this->get('dk_pc_factory')->create();
        }
        
        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new PlayerCharacterType(), $pc);
        
        if($request->getMethod() === 'GET') {
            
            //If PC is related to a campaign... 
            if($pc->getCampaign()) {
                
                //With no characteristics...
                if($pc->getCharacteristics()->isEmpty()) {
                   
                    $ruleChars = $pc->getCampaign()->getRuleset()->getCharacteristics();
                    
                    foreach($ruleChars as $rc) {
                        $char = new PlayerCharacterCharacteristic();
                        $char->setValue(0);
                        $char->setCharacteristic($rc);
                                
                        $pc->addCharacteristics($char);
                    }
                    
                    $em->persist($pc);
                    
                    $em->flush();
                    
                    $form->setData($pc);
                    
                }
            }
      
               
            return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', ['form' => $form->createView(), 'pc' => $pc]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {
    
                $em->persist($pc);
                
                $em->flush();
                
                return $this->forward('DkSystemBundle:Board:index');
                
            } else {
                
                return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', ['form' => $form->createView(), 'pc' => $pc]);
            
            }
            
        }
       
    }
}
