<?php
namespace Dk\Bundle\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Dk\Bundle\SystemBundle\Form\RegisterType;
use Dk\Bundle\SystemBundle\Form\LoginType;
use Dk\Bundle\SystemBundle\Entity\Player;

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
          
        if('GET' == $request->getMethod()) {
           
           
        } elseif('POST' == $request->getMethod()) {
            
            $player = new Player();
            
            $registerForm->setData($player);
            
            $registerForm->handleRequest($request);
            
            if($registerForm->isValid()) {
                
                $efactory = $this->container->get('security.encoder_factory');
                $encoder  = $efactory->getEncoder($player);
                $password = $encoder->encodePassword($player->getPassword(), $player->getSalt());
                
                $player->setPassword($password);
                
                $em = $this->get('doctrine')->getManager();
                
                $em->persist($player);
                $em->flush();
                
                $token = new UsernamePasswordToken($player, null, 'main', $player->getRoles());
                $this->get('security.context')->setToken($token);
                
                return $this->redirect($this->generateUrl('players'));
            } 
          
        }
                
        return $this->render('DkSystemBundle::home.html.twig', [
            'error'         => $error,
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'register_form' => $registerForm->createView(),
            'login_form'    => $loginForm->createView()
        ]);
    }
  
}