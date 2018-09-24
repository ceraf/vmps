<?php

namespace App\AdminBundle\Model\Formtypes;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PreviewType extends AbstractType
{
    public function getParent()
    {
        return TextType::class;
    }
	
    public function getName()
    {
        return 'preview';
    }
}