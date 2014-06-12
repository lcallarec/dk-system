<?php

namespace Dk\Bundle\SystemBundle\Controller\Ruleset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RulesetController
 *
 * @package Dk\Bundle\SystemBundle\Controller\Ruleset
 */
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
            throw $this->createNotFoundException($this->get('translator')->trans('ruleset.not.found', [], 'ruleset'));
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

                return $this->render('DkSystemBundle:Ruleset:form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }

}
