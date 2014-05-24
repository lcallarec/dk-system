<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\PlayerCharacter\PlayerCharacterType;
use Dk\Bundle\SystemBundle\PlayerCharacterEvents;
use Dk\Bundle\SystemBundle\Events\PlayerCharacterEvent;
/**
 * Class CharacterController
 *
 * @package Dk\Bundle\SystemBundle\Controller
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
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
            $pc = $this->get('dk.pc.manager')->getWithRelationships($id);

            if(null === $pc) {
                throw $this->createNotFoundException("Ce personnage n'existe pas ou n'existe plus");
            }
            
        } else {
            $pc = $this->get('dk.factory.pc')->create();
        }

        $form = $this->createForm(new PlayerCharacterType(), $pc);

        if ($form->has('assets')) {
            $assets = $form->get('assets')->getConfig()->getOptions()['choice_list']->getChoices();
        } else {
            $assets = [];
        }

        $form->handleRequest($request);

        return $this->processForm($form, $pc, $assets);
       
    }

    /**
     * @param Form $form
     * @param $pc
     * @param $assets
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function processForm(Form $form, $pc, $assets)
    {
        if($form->isValid()) {

            $this->get('dk.pc.manager')->save($pc);

            return $this->redirect($this->generateUrl('board'));
        }

        return $this->render('DkSystemBundle:PlayerCharacter:form.html.twig', [
            'form'   => $form->createView(),
            'pc'     => $pc,
            'assets' => $assets
        ]);

    }
}
