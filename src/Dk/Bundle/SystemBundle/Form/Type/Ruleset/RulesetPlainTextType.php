<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Ruleset;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dk\Bundle\SystemBundle\Form\DataTransformer\ChoiceToTextTransformer;

/**
 * Class RulesetPlainTextType represent a plain tex ruleset
 *
 * @package Dk\Bundle\SystemBundle\Form\Type\Ruleset
 */
class RulesetPlainTextType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            $builder
                ->create('name', 'plain_text', [
                    'label' => 'Système de règles',
                    'help'  => 'Il est impossible de modifier le système de règle d\'une campagne après sa création'
                ])
                ->addModelTransformer(new ChoiceToTextTransformer())
        );
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
