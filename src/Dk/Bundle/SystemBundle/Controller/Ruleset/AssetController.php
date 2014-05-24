<?php

namespace Dk\Bundle\SystemBundle\Controller\Ruleset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetAssetCollectionType;

/**
 * Class AssetController
 *
 * @package Dk\Bundle\SystemBundle\Controller\Ruleset
 */
class AssetController extends Controller
{
   

    /**
    * Manage Ruleset assets
    */
    public function manageAssetAction($id)
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