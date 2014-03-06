<?php
namespace Dk\Bundle\SystemBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

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

