<?php

namespace Dk\Bundle\SystemBundle\Controller\Ruleset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetPlayableRaceCollectionType;

/**
 * Class PlayableRaceController
 *
 * @package Dk\Bundle\SystemBundle\Controller\Ruleset
 */
class PlayableRaceController extends Controller
{
   

   /**
    * Manage Playable races skills
    */
    public function managePlayableRaceAction($id)
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
}
