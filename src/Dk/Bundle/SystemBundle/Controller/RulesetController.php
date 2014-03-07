<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dk\Bundle\SystemBundle\Form\RulesetType;
use Dk\Bundle\SystemBundle\Form\RulesetSkillCollectionType;

class RulesetController extends Controller
{
   
   /**
    * Manage Rulesets
    */
    public function manageAction($id)
    {
        $request = $this->getRequest();
        
        //A ruleset can't be created this way yet
        if(null !== $id) {
            $ruleset = $this->get('doctrine')->getRepository('DkSystemBundle:Ruleset')->findOneWithRelationships($this->getUser(), $id);
        }
        
        if(null === $ruleset || null === $id) {
            throw $this->createNotFoundException("Ce système de règles n'existe pas ou n'existe plus");
        }

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetType(), $ruleset);
        
        if($request->getMethod() === 'GET') {
 
            return $this->render('DkSystemBundle:Ruleset:form.html.twig', ['form' => $form->createView()]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {
    
                $em->persist($ruleset);
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('board'));
                
            } else {

                //return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', ['form' => $form->createView(), 'pc' => $pc]);
            
            }
            
        }
       
    }
    
   /**
    * Manage Ruleset skills
    */
    public function manageSkillsAction($id)
    {
        $request = $this->getRequest();
        
        //A ruleset can't be created this way yet
        if(null !== $id) {
            $skills = $this->get('doctrine')->getRepository('DkSystemBundle:Ruleset')->findOneWithSkills($this->getUser(), $id);
        }

        if(null === $id) {
            throw $this->createNotFoundException("Ce système de règles n'existe pas ou n'existe plus. Aucune coméptence à gérer.");
        }

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetSkillCollectionType(), $skills);
        
        if($request->getMethod() === 'GET') {
 
            return $this->render('DkSystemBundle:Ruleset:Skill/form.html.twig', ['form' => $form->createView()]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {
    
                $em->persist($skills);
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
                
            } else {

                return $this->render('DkSystemBundle:Ruleset:Skill/form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
    
//   /**
//    * Manage Playable races skills
//    */
//    public function managePlayableRacesAction($id)
//    {
//        $request = $this->getRequest();
//        
//        //A ruleset can't be created this way yet
//        if(null !== $id) {
//            $races = $this->get('doctrine')->getRepository('DkSystemBundle:Ruleset')->findOneById($id);
//        }
//
//        if(null === $id) {
//            throw $this->createNotFoundException("Ce système de règles n'existe pas ou n'existe plus. Aucune coméptence à gérer.");
//        }
//
//        $em = $this->get('doctrine')->getManager();
//        
//        $form = $this->createForm(new RulesetSkillCollectionType(), $skills);
//        
//        if($request->getMethod() === 'GET') {
// 
//            return $this->render('DkSystemBundle:Ruleset:Skill/form.html.twig', ['form' => $form->createView()]);
//         
//        } else {
//    
//            $form->handleRequest($request);
//            
//            if($form->isValid()) {
//    
//                $em->persist($skills);
//                
//                $em->flush();
//                
//                return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
//                
//            } else {
//
//                return $this->render('DkSystemBundle:Ruleset:Skill/form.html.twig', ['form' => $form->createView()]);
//            
//            }
//            
//        }
//       
//    }    
    
}
