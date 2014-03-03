<?php
namespace Dk\PlayerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Dk\PlayerBundle\Form\RegisterType;
use Dk\PlayerBundle\Form\LoginType;

class HomeController extends Controller
{
    public function indexAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        $registerForm = $this->createForm(new RegisterType());
        $loginForm    = $this->createForm(new LoginType());
        
        return $this->render('DkPlayerBundle::home.html.twig', [
            'error'         => $error,
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'register_form' => $registerForm->createView(),
            'login_form'    => $loginForm->createView()
        ]);
    }
  
}
