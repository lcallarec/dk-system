<?php

namespace Dk\Bundle\SystemBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dk\Bundle\SystemBundle\Entity\Campaign'
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
