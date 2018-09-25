<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use App\AdminBundle\Model\Formtypes\MacType;
use App\AdminBundle\Model\Formtypes\IpType;
use App\Entity\Host as Entity;

class NasForm extends AbstractType
{
    protected $ip;

    protected $formName = self::class;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;

        $builder->add(
            'ip',
            IpType::class,
            [
                'label' => 'Ip',
                'required' => true,
                'attr' => [
                    'bt_size' => '12'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Enter the Ip'])
                ]
            ]
        );
    }

    public function getName()
    {
        return $this->formName;
    }
    
    public function getFields()
    {
        return $this->fields;
    }
    
    public function getIp()
    {
        return $this->username;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }
    
    public function setDefaultOptions(array $options)
    {
        return array(
            'data_class' => Entity::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'intention' => 'task_item',
        );
    }

}
