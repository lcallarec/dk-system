<?php
namespace Dk\Bundle\SystemBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * Render a plain text widget
 *
 * @author laurent
 */
class PlainTextType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(['help']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }
    
    public function getName()
    {
        return 'plain_text';
    }
    
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['help'] = $options['help'];
    }
}
