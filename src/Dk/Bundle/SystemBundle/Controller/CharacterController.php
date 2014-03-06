<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dk\Bundle\SystemBundle\Form\PlayerCharacterType;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacterCharacteristic;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacterSkill;

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
                throw $this->createNotFoundException("Ce personnage n'existe pas ou n'existe plus");
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
                                
                        $pc->addCharacteristic($char);
                    }

                }
                   
                if($pc->getSkills()->isEmpty()) {
                    
                    $ruleSkills = $pc->getCampaign()->getRuleset()->getSkills();
                    foreach($ruleSkills as $rs) {
                        $skill = new PlayerCharacterSkill();
                        $skill->setValue(0);
                        $skill->setRulesetSkill($rs);
                                
                        $pc->addSkill($skill);
                    }
                }
                
                $em->persist($pc);
                    
                $em->flush();

                $form->setData($pc);
            }

            return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', ['form' => $form->createView(), 'pc' => $pc]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {
    
                $em->persist($pc);
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('board'));
                
            } else {

                return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', ['form' => $form->createView(), 'pc' => $pc]);
            
            }
            
        }
       
    }
}
