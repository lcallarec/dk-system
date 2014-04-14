<?php

namespace Dk\Bundle\SystemBundle\Form\Type\PlayerCharacter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class PlayerCharacterSkillType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value')
        ;
        
         
    }

   /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\PlayerCharacterSkill'
        ));
    }    
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'char';
    }
}
