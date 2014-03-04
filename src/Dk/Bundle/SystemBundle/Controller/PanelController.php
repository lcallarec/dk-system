<?php

namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Entity\Player;
use Dk\Bundle\SystemBundle\Form\PlayerType;

class PanelController extends Controller
{
    /**
     */
    public function indexAction()
    {
        return $this->render('DkSystemBundle:Panel:index.html.twig');
    }

}
