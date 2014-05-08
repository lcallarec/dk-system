<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetType;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetSkillCollectionType;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetPlayableRaceCollectionType;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetAssetCollectionType;
use Symfony\Component\HttpFoundation\Request;

class RulesetController extends Controller
{
   
   /**
    * Manage Rulesets
    */
    public function manageAction(Request $request, $id)
    {
        //A ruleset can't be created this way yet
        if(null !== $id) {
            $ruleset = $this->get('doctrine')->getRepository('DkSystemBundle:Ruleset')->findOneWithRelationships($this->getUser(), $id);
        }
        
        if(null === $ruleset || null === $id) {
            throw $this->createNotFoundException("Ce système de règles n'existe pas ou n'existe plus");
        }

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetType(), $ruleset);
        $form->add('submit', 'submit');

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
    
   /**
    * Manage Playable races skills
    */
    public function managePlayableRacesAction($id)
    {
        $request = $this->getRequest();
        
        if(null !== $id) {
            $ruleset = $this->get('doctrine')
                          ->getRepository('DkSystemBundle:Ruleset')
                          ->findOneWithPlayableRaces($this->getUser(), $id)
            ;
        }

        if(null === $id) {
            throw $this->createNotFoundException("Ce système de règles n'existe pas ou n'existe plus. Aucune race jouable à gérer.");
        }

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetPlayableRaceCollectionType(), $ruleset);
        
        if($request->getMethod() === 'GET') {
 
            return $this->render('DkSystemBundle:Ruleset:PlayableRace/form.html.twig', ['form' => $form->createView()]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {
    
                $em->persist($ruleset);
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
                
            } else {

                return $this->render('DkSystemBundle:Ruleset:PlayableRace/form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
    
 /**
    * Manage Ruleset assets
    */
    public function manageAssetsAction($id)
    {
        $request = $this->getRequest();
        
        if(null !== $id) {
            $ruleset = $this->get('doctrine')
                           ->getRepository('DkSystemBundle:Ruleset')
                           ->findOneWithAssets($this->getUser(), $id);
        }

        if(null === $id) {
            throw $this->createNotFoundException("Ce système de règles n'existe pas ou n'existe plus. Aucun atouts à gérer.");
        }

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetAssetCollectionType(), $ruleset);
        
        if($request->getMethod() === 'GET') {
 
            return $this->render('DkSystemBundle:Ruleset:Asset/form.html.twig', ['form' => $form->createView()]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {
    
                $em->persist($ruleset);
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
                
            } else {

                return $this->render('DkSystemBundle:Ruleset:Asset/form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
        
    
}
