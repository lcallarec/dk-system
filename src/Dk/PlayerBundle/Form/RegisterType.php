<?php
namespace Dk\PlayerBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends PlayerType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
        $builder
            ->add('account_type', 'choice', [
                'mapped'  => false,
                'choices' => ['ROLE_PLAYER' => 'joueur', 'ROLE_MASTER' => 'maître']
            ])
            ->add('email')
            ->add('submit', 'submit', ['label' => 'créer son compte'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\PlayerBundle\Entity\Player'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'register';
    }
}
