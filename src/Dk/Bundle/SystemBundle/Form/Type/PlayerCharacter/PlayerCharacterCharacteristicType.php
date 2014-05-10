<?php

namespace Dk\Bundle\SystemBundle\Form\Type\PlayerCharacter;

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
            ->add('value', 'integer', [
                'attr' => [
                    'min' => -5,
                    'max' => 5
                ]
            ])
        ;
        
        $builder->add(
            $builder
                ->create('characteristic', 'plain_text', ['property_path' => 'rulesetCharacteristic'])
                ->addModelTransformer(new ChoiceToTextTransformer())
        );
    }

   /**
    * @param OptionsResolverInterface $resolver
    */
   public function setDefaultOptions(OptionsResolverInterface $resolver)
   {
        $resolver->setDefaults([
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\PlayerCharacterCharacteristic'
        ]);
   }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'char';
    }
}
