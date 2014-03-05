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
        
        if(null !== $id) {
            $campaign = $this->get('doctrine')->getRepository('DkSystemBundle:Campaign')->findOneById($id);
        
            if(!$campaign) {
                $this->createNotFoundException("Cette campagne n'existe pas");
            }
        } else {
            $campaign = $this->get('dk_campaign_factory')->create();
        }
        
        $form = $this->createForm(new CampaignType(), $campaign);
        
        if($request->getMethod() === 'GET') {
            
            return $this->render('DkSystemBundle:Campaign:form.html.twig', ['form' => $form->createView()]);
         
        } else {
             
            $form->handleRequest($request);
             
            if($form->isValid()) {
                
                $em = $this->get('doctrine')->getManager();

                $em->flush();
                $em->persist($campaign);
                
                $em->flush();
                
                return $this->forward('DkSystemBundle:Board:index');
                
            } else {
                
                return $this->render('DkSystemBundle:Campaign:form.html.twig', ['form' => $form->createView()]);
            
            }
            
        }
       
    }
}

