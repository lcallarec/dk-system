<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\CampaignType;

class CampaignController extends Controller
{

   /**
    */
    public function manageAction($id)
    {
        $request = $this->getRequest();
        
        $options = [];
        
        if(null !== $id) {
            $campaign = $this->get('doctrine')->getRepository('DkSystemBundle:Campaign')->findOneById($id);
        
            if(!$campaign) {
                $this->createNotFoundException("Cette campagne n'existe pas");
            }
            
            $options['isnew'] = false;
            
        } else {
            $campaign = $this->get('dk_campaign_factory')->create();
            $options['isnew'] = true;
        }
        
        $form = $this->createForm(new CampaignType(), $campaign, $options);
        
        if($request->getMethod() === 'GET') {
            
            return $this->render('DkSystemBundle:Campaign:form.html.twig', ['form' => $form->createView()]);
         
        } else {
            
            //Can't modify a campaign ruleset after creation
            $form->remove('ruleset');
            
            $form->handleRequest($request);
    
            if($form->isValid()) {
                
                $em = $this->get('doctrine')->getManager();
                
                //Retrieve already related PCs
                $pcs = $em->getRepository('DkSystemBundle:PlayerCharacter')->findByCampaign($campaign);
                
                foreach($pcs as $pc) {
                    $campaign->addPlayerCharacter($pc);
                }
                
                $em->persist($campaign);
                
                $em->flush();
                
                return $this->forward('DkSystemBundle:Board:index');
                
            } else {

                return $this->render('DkSystemBundle:Campaign:form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
}

