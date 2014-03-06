<?php
namespace Dk\Bundle\SystemBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceListInterface;

/**
 * @author Laurent CALLAREC
 */
class ChoiceToTextTransformer implements DataTransformerInterface
{
    
    public function transform($choice)
    {
        return (string) $choice;
    }

    public function reverseTransform($value)
    {
       return $value;
    }
}

