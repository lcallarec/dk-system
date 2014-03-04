<?php

namespace Dk\Bundle\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends PlayerType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('password', 'password')
            ->add('submit', 'submit', ['label' => 'se connecter'])
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'login';
    }
}
