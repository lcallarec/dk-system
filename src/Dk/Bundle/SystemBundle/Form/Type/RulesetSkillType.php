<?php

namespace Dk\Bundle\SystemBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RulesetSkillType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $optionsbu
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('overloadMalus')
            ->add('description')
            ->add('ruleset')
            ->add('char1')
            ->add('char2')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\RulesetSkill'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skill';
    }
}
