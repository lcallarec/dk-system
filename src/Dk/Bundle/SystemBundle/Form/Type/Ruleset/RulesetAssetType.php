<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Ruleset;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dk\Bundle\SystemBundle\Entity\Ruleset;

class RulesetAssetType extends AbstractType
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
            ->add('name', 'text')
            ->add('useLimitation', 'text', [
                    'label' => 'ruleset.asset.useLimitation'
                ])
            ->add('useCost', 'text', [
                    'label' => 'ruleset.asset.useCost'
                ])
            ->add('description', 'textarea', [
                    'label' => 'ruleset.asset.description'
                ])
            ->add('preRequisite', 'text', [
                    'label' => 'ruleset.asset.preRequisite'
                ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\RulesetAsset',
            'translation_domain' => 'ruleset'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'asset';
    }
}
