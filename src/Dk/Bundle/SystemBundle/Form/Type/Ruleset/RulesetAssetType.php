<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Ruleset;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Dk\Bundle\SystemBundle\Entity\Ruleset;

class RulesetAssetType extends AbstractType
{
    /**
     * The ruleset for this skill
     * @var Ruleset
     */
    private $ruleset;
    
    /**
     * 
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
            ->add('name')
            ->add('useLimitation')
            ->add('useCost')
            ->add('description')
            ->add('preRequisite')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\RulesetAsset'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asset';
    }
}
