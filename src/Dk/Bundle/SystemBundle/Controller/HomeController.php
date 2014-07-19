<?php
namespace Dk\Bundle\SystemBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Dk\Bundle\SystemBundle\Form\Type\Player\RegisterType;
use Dk\Bundle\SystemBundle\Form\Type\Player\LoginType;
use Dk\Bundle\SystemBundle\Entity\Player;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;
/**
 * Class HomeController
 *
 * @package Dk\Bundle\SystemBundle\Controller
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->get('doctrine')->getEntityManager();

        $e1 = new Player();
        $e1->setNickname('frfr');
        $e2 = new Player();

        $meta = $em->getClassMetadata(get_class($e1));

        $identifiers = $meta->getIdentifierColumnNames();


        $fields = $meta->getFieldNames();


        $accessor = PropertyAccess::createPropertyAccessor();

        $subjects = [$e1, $e2];
        $diff = [];
        foreach ($fields as $field) {

            if ($accessor->getValue($e1, $field) !== $accessor->getValue($e2, $field)) {
                $diff[$field] = true;
            }


        }

        echo '<pre>';
        \Doctrine\Common\Util\Debug::dump($diff, 4);
        die();



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

            return $this->redirect($this->generateUrl('board'));
        }

        return $this->render('DkSystemBundle::home.html.twig', [
            'error'         => $error,
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'register_form' => $registerForm->createView(),
            'login_form'    => $loginForm->createView()
        ]);
    }
  
}
