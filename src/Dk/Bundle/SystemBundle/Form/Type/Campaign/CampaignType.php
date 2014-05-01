<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Campaign;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dk\Bundle\SystemBundle\Repository\PlayerCharacterRepository;
use Dk\Bundle\SystemBundle\Form\Type\Ruleset\RulesetPlainTextType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class CampaignType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'campaign.name'
            ])
            ->add('playerCharacters', 'entity', 
                [
                    'class'     => 'DkSystemBundle:PlayerCharacter',
                    'expanded'  => true,
                    'multiple'  => true,
                    'by_reference' => false,
                    'query_builder' => function(PlayerCharacterRepository $pr) {
                            return $pr->createQueryBuilder('pc')
                                ->where('pc.campaign IS NULL')
                                ->orderBy('pc.firstname', 'ASC');
                    },
                ])
            ->add('submit', 'submit')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {

            $data = $event->getData();
            $form = $event->getForm();

            if (null === $data->getId()) {
                $form->add('ruleset', 'entity', [
                    'class'     => 'DkSystemBundle:Ruleset',
                    'label' => 'Système de règles'
                ]);
            } else {
                $form->add('ruleset', new RulesetPlainTextType());
            }

        });

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\Campaign',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'campaign';
    }
}
