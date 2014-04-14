<?php

namespace Dk\Bundle\SystemBundle\Form\Type\Player;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname', 'text', [
                'label' => 'user.nickname'
             ])
            ->add('password', 'password', [
                'label' => 'user.password'
            ])
            ->add('submit', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\Player'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'player';
    }
}
