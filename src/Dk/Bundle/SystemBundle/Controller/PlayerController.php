<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Form\Type\Player\PlayerType;

/**
 * Class PlayerController
 *
 * @package Dk\Bundle\SystemBundle\Controller
 */
class PlayerController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function manageAction(Request $request)
    {
        $player = $this->getUser();
        
        $form = $this->createForm(new PlayerType(), $player);

        $form->handleRequest($request);

        return $this->processForm($form, $player);
    }

    /**
     * @param Form $form
     * @param Player $player
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function processForm(Form $form, Player $player)
    {
        if($form->isValid()) {

            $em = $this->get('doctrine')->getManager();

            $em->persist($player);

            $em->flush();

            return $this->forward('DkSystemBundle:Board:index');
        }

        return $this->render('DkSystemBundle:Player:account.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
