<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Dk\Bundle\SystemBundle\Entity\Campaign;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Campaign\CampaignType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CampaignController
 *
 * @package Dk\Bundle\SystemBundle\Controller
 */
class CampaignController extends Controller
{

   /**
    */
    public function manageAction(Request $request, $id)
    {

        if(null !== $id) {
            /** @var Campaign $campaign */
            $campaign = $this->get('doctrine')->getRepository('DkSystemBundle:Campaign')->findOneById($id);
        
            if(!$campaign) {
                $this->createNotFoundException("Cette campagne n'existe pas");
            }

        } else {
            /** @var Campaign $campaign */
            $campaign = $this->get('dk.factory.campaign')->create();
        }

        $form = $this->createForm(new CampaignType(), $campaign);
        
        if($request->getMethod() === 'GET') {
            
            return $this->render('DkSystemBundle:Campaign:form.html.twig', ['form' => $form->createView()]);
         
        } else {
            
            //Can't modify a campaign ruleset after creation
            $form->remove('ruleset');

            $form->handleRequest($request);

            if($form->isValid()) {

                /** @var EntityManager $em */
                $em = $this->get('doctrine')->getManager();

                //Retrieve already related PCs
                /** @var ArrayCollection $pcs */
                $pcs = $em->getRepository('DkSystemBundle:PlayerCharacter')->findByCampaign($campaign);

                /** @var PlayerCharacter $pc */
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

