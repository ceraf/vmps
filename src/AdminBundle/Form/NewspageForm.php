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

use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use App\Entity\Newspage as Entity;

class NewspageForm extends AbstractType
{
    protected $title;
    protected $description;
    protected $short_desct;
    protected $url;
    protected $category;
	
    protected $formName = self::class;

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;

        $builder->add(
            'title',
            TextType::class,
            [
                'label' => 'Name',
                'required' => false,
                'attr' => [
                    'size' => '12'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Enter the title'])
                ]
            ]
        );

        $builder->add(
            'short_desct',
            TextareaType::class,
            [
                'label' => 'Short Description',
                'required' => false,
                'attr' => array(
                    'rows' => '10',
                    'size' => '12'
                ),
                'constraints' => [
                    new NotBlank(['message' => 'Enter the description'])
                ]
            ]
        );  
        
        $builder->add(
            'description',
            TextareaType::class,
            [
                'label' => 'Description',
                'required' => false,
                'attr' => array(
                    'rows' => '10',
                    'size' => '12',
                    'ckeditor' => 1
                ),
                'constraints' => [
                    new NotBlank(['message' => 'Enter the description'])
                ]
            ]
        );        

        $builder->add(
            'category',
            EntityType::class,
            [
                'label' => 'Категория',
                'class' => 'App:Newscategory',
                'choice_label' => 'title',
                'multiple' => true
            ]
        );  
        
        $builder->add(
            'url',
            TextType::class,
            [
                'label' => 'Url',
                'required' => true
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
    
    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($title)
    {
        $this->title = $url;
    }
	
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getShortDescription()
    {
        return $this->description;
    }

    public function setShortDescription($description)
    {
        $this->description = $description;
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
