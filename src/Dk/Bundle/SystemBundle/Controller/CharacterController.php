<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\PlayerCharacter\PlayerCharacterType;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacterCharacteristic;
use Dk\Bundle\SystemBundle\Entity\PlayerCharacterSkill;

class CharacterController extends Controller
{

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function manageAction(Request $request,  $id)
    {
        if(null !== $id) {
            $pc = $this->get('doctrine')->getRepository('DkSystemBundle:PlayerCharacter')->findOneWithRelationships($this->getUser(), $id);

            if(null === $pc) {
                throw $this->createNotFoundException("Ce personnage n'existe pas ou n'existe plus");
            }
            
        } else {
            $pc = $this->get('dk.factory.pc')->create();
        }

        $pcManager = $this->get('dk.pc.manager');

        $form = $this->createForm(new PlayerCharacterType(), $pc);

        if ($form->has('assets')) {
            $assets = $form->get('assets')->getConfig()->getOptions()['choice_list']->getChoices();
        } else {
            $assets = [];
        }


        if($request->getMethod() === 'GET') {
 
            //If PC is related to a campaign... 
            if($pc->getCampaign()) {
                
                $pcManager->save($pc);
                $form->setData($pc);
            }

            return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', [
                'form'   => $form->createView(),
                'pc'     => $pc,
                'assets' => $assets
            ]);
         
        } else {
    
            $form->handleRequest($request);
            
            if($form->isValid()) {

                $pcManager->save($pc);

                return $this->redirect($this->generateUrl('board'));
                
            } else {

                return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', [
                    'form'   => $form->createView(),
                    'pc'     => $pc,
                    'assets' => $assets
                ]);
            
            }
            
        }
       
    }

}
