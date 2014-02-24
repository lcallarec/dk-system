<?php

namespace Dk\PlayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PlayerController extends Controller
{
    /**
     */
    public function showAllAction()
    {
        $players = $this->get('doctrine')->getRepository('DkPlayerBundle:Player')->findAll();
        
        return $this->render('DkPlayerBundle:Player:all.html.twig', ['players' => $players]);
    }
}
