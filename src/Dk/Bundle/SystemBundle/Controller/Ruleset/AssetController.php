<?php

namespace Dk\Bundle\SystemBundle\Controller\Ruleset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetAssetCollectionType;

/**
 * Class AssetController
 *
 * @package Dk\Bundle\SystemBundle\Controller\Ruleset
 */
class AssetController extends Controller
{
    /**
    * Manage Ruleset assets
     *
     * @param Request $request
     * @param int $id
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return Response|RedirectResponse
     */
    public function manageSkillAction(Request $request, $id)
    {
        if(null !== $id) {
            $ruleset = $this->get('doctrine')
               ->getRepository('DkSystemBundle:Ruleset')
               ->findOneWithAssets($this->getUser(), $id)
            ;
        }

        if(null === $id) {
            throw $this->createNotFoundException($this->get('translator')->trans('ruleset.not.found', [], 'ruleset'));
        }

        $em = $this->get('doctrine')->getManager();
        
        $form = $this->createForm(new RulesetAssetCollectionType(), $ruleset);

        $form->handleRequest($request);

        if($form->isValid()) {

            $em->persist($ruleset);

            $em->flush();

            return $this->redirect($this->generateUrl('manage_ruleset', ['id' => $id]));
        }

        return $this->render('DkSystemBundle:Ruleset:Asset/form.html.twig', ['form' => $form->createView()]);
    }
}
