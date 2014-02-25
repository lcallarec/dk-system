<?php
namespace Dk\PlayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('DkPlayerBundle::home.html.twig');
    }
}
