<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Ruleset;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RulesetType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'ruleset.name'
            ])
            ->add('owner', 'entity', [
                'class' => 'Dk\Bundle\SystemBundle\Entity\Player',
                'label' => 'ruleset.owner'
            ])
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\Ruleset',
            'translation_domain' => 'ruleset'
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
