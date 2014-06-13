<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Ruleset;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dk\Bundle\SystemBundle\Entity\Ruleset;

class RulesetSkillType extends AbstractType
{
    /** @var Ruleset */
    private $ruleset;
    
    /**
     * @param Ruleset $ruleset
     */
    public function __construct(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                    'label' => 'ruleset.skill.name'
                ])
            ->add('overloadMalus', 'checkbox', [
                    'label' => 'ruleset.skill.overloadMalus',
                    'required' => false
                ])
            ->add('description', 'textarea')
            ->add('char1', 'entity', [
                'choices' => $this->ruleset->getCharacteristics(),
                'class'   => 'DkSystemBundle:RulesetCharacteristic'
            ])
            ->add('char2', 'entity', [
                'choices' => $this->ruleset->getCharacteristics(),
                'class'   => 'DkSystemBundle:RulesetCharacteristic'
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\RulesetSkill',
            'translation_domain' => 'ruleset'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skill';
    }
}
