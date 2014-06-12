<?php

namespace Dk\Bundle\SystemBundle\Controller\Ruleset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetPlayableRaceCollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class PlayableRaceController
 *
 * @package Dk\Bundle\SystemBundle\Controller\Ruleset
 */
class PlayableRaceController extends Controller
{
    /**
     * Manage Playable races skills
     *
     * @param Request $request
     * @param int     $id
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response|RedirectResponse
     */
    public function managePlayableRaceAction(Request $request, $id)
    {

        if (null !== $id) {
            $ruleset = $this
                ->get('doctrine')
                ->getRepository('DkSystemBundle:Ruleset')
                ->findOneWithPlayableRaces($this->getUser(), $id)
            ;
        }

        if (null === $id) {
            throw $this->createNotFoundException($this->get('translator')->trans('ruleset.not.found', [], 'ruleset'));
        }

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetPlayableRaceCollectionType(), $ruleset);
        $form->add('submit', 'submit');

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($ruleset);

            $em->flush();

            return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
        }

        return $this->render('DkSystemBundle:Ruleset:PlayableRace/form.html.twig', ['form' => $form->createView()]);
    }
}
