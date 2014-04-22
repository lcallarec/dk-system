<?php

namespace Dk\Bundle\SystemBundle\Form\Type\PlayerCharacter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PlayerCharacterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('submit', 'submit')
            ->add('characteristics', 'collection', [
                'type' => new PlayerCharacterCharacteristicType(),
                'by_reference' => true,
                'label' => false
            ])
        ;
        
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            
            $data = $event->getData();
            $form = $event->getForm();

            if (null !== $data->getCampaign()) {
                $form
                    ->add(
                        'assets', 'entity', [
                            'class'    => 'Dk\Bundle\SystemBundle\Entity\RulesetAsset',
                            'expanded' => true,
                            'multiple' => true,
                        ]
                    )
                    ->add(
                        'race', 'entity', [
                            'choices' => $data->getCampaign()->getRuleset()->getPlayableRaces(),
                            'class'   => 'Dk\Bundle\SystemBundle\Entity\RulesetPlayableRace'
                        ]
                    )
                    ->add(
                        'skills', 'collection', [
                            'type'         => new PlayerCharacterSkillType(),
                            'by_reference' => true,
                            'label'        => false
                        ]
                    )
                ;
            }

        });      
        
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\PlayerCharacter'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pc';
    }
}
