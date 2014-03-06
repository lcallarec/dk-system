<?php

namespace Dk\Bundle\SystemBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

use Dk\Bundle\SystemBundle\Form\DataTransformer\ChoiceToTextTransformer;


class PlayerCharacterCharacteristicType extends AbstractType
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
        
         $builder->add(
                $builder
                    ->create('characteristic', 'plain_text', [
                           
                     ])
                    ->addModelTransformer(new ChoiceToTextTransformer())
            );
    }

   /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\PlayerCharacterCharacteristic'
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
