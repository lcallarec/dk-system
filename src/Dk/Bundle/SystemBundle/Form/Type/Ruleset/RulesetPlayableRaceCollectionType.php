<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Ruleset;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RulesetPlayableRaceCollectionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            
            $form = $event->getForm();
            
            $form->add('races', 'collection', [
                'type'          => new RulesetPlayableRaceType($event->getData()),
                'label'         => false,
                'by_reference'  => false,
                'property_path' => 'playableRaces'
            ]);
        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\Ruleset'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ruleset';
    }
}
