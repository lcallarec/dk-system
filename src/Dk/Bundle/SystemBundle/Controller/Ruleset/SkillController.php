<?php

namespace Dk\Bundle\SystemBundle\Controller\Ruleset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetSkillCollectionType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SkillController
 *
 * @package Dk\Bundle\SystemBundle\Controller\Ruleset
 */
class SkillController extends Controller
{
   /**
    * Manage Ruleset skills
    *
    * @param Request $request
    * @param int     $id
    *
    * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
    *
    * @return Response|RedirectResponse
    */
    public function manageSkillAction(Request $request, $id)
    {
        if(null !== $id) {
            $skills = $this
                ->get('doctrine')
                ->getRepository('DkSystemBundle:Ruleset')
                ->findOneWithSkills($this->getUser(), $id)
            ;
        }

        if(null === $id) {
            throw $this->createNotFoundException($this->get('translator')->trans('ruleset.not.found', [], 'ruleset'));
        }

        $skillGroups = $this->get('doctrine')->getRepository('DkSystemBundle:RulesetSkillGroup')->findByRuleset($skills);

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetSkillCollectionType(), $skills);


        $form->handleRequest($request);

        if($form->isValid()) {

            $em->persist($skills);

            $em->flush();

            return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
        }

        return $this->render('DkSystemBundle:Ruleset:Skill/form.html.twig', [
            'form'        => $form->createView(),
            'skillGroups' => $skillGroups
        ]);
    }
}
