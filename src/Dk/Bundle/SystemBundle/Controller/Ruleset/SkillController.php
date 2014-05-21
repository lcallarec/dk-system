<?php

namespace Dk\Bundle\SystemBundle\Controller\Ruleset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetSkillCollectionType;

/**
 * Class SkillController
 *
 * @package Dk\Bundle\SystemBundle\Controller\Ruleset
 */
class SkillController extends Controller
{
   
   /**
    * Manage Ruleset skills
    */
    public function manageSkillAction($id)
    {
        $request = $this->getRequest();
        
        if(null !== $id) {
            $skills = $this->get('doctrine')->getRepository('DkSystemBundle:Ruleset')->findOneWithSkills($this->getUser(), $id);
        }

        if(null === $id) {
            throw $this->createNotFoundException("Ce système de règles n'existe pas ou n'existe plus. Aucune coméptence à gérer.");
        }

        $skillGroups = $this->get('doctrine')->getRepository('DkSystemBundle:RulesetSkillGroup')->findByRuleset($skills);

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetSkillCollectionType(), $skills);

        if($request->getMethod() === 'GET') {
 
            return $this->render('DkSystemBundle:Ruleset:Skill/form.html.twig', [
                'form'        => $form->createView(),
                'skillGroups' => $skillGroups
            ]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {
    
                $em->persist($skills);
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
                
            } else {

                return $this->render('DkSystemBundle:Ruleset:Skill/form.html.twig', [
                    'form'        => $form->createView(),
                    'skillGroups' => $skillGroups
                ]);
            
            }
            
        }
       
    }

}
