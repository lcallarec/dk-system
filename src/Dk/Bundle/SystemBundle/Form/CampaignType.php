<?php

namespace Dk\Bundle\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\Extension\Core\DataTransformer\ChoiceToValueTransformer;
use Dk\Bundle\SystemBundle\Repository\PlayerCharacterRepository;

class CampaignType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('playerCharacters', 'entity', 
                [
                    'class'     => 'DkSystemBundle:PlayerCharacter',
                    'expanded'  => true,
                    'multiple'  => true,
                    'by_reference' => false,
                    'query_builder' => function(PlayerCharacterRepository $pr) {
                            return $pr->createQueryBuilder('pc')
                                ->where('pc.campaign IS NULL')
                                ->orderBy('pc.firstname', 'ASC');
                    },                    
                ])
            ->add('submit', 'submit')
        ;
                    
        if(!isset($options['isnew'])) {
            $builder->add('ruleset', 'entity', [
                'class'     => 'DkSystemBundle:Ruleset',
                'label' => 'Système de règles'
            ]);
        } else {
           
            $builder->add(
                $builder
                    ->create('ruleset', 'plain_text', [
                             'label' => 'Système de règles',
                             'help'  => 'Il est impossible de modifier le système de règle d\'une campagne après sa création'
                        ])
                    ->addModelTransformer(new DataTransformer\ChoiceToTextTransformer())
            );
        }
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\Campaign',
            'isnew'      => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'campaign';
    }
}
