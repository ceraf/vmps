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
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\AdminBundle\Model\Formtypes\UserpasswordType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use App\Entity\User as Entity;

class UserForm extends AbstractType
{
    protected $username;
    protected $password;
    protected $email;
    protected $is_active;
    
    protected $options;
	
    protected $formName = 'users';

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;

        $builder->add(
            'username',
            TextType::class,
            [
                'label' => 'Имя пользователя',
                'required' => false,
                'attr' => [
                    'size' => '12'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Введите имя пользователя'])
                ]
            ]
        );
        
        $builder->add(
            'password',
            RepeatedType::class,
            [
                'type' => UserpasswordType::class,
                'required' => false,
                
                'options' => array('attr' => array('size' => '6')),
                'first_options'  => array('label' => 'Пароль'),
                'second_options'  => array('label' => 'Подтверждение пароля'),
                'constraints' => [
                    new NotBlank(['message' => 'Введите пароль'])
                ]
            ]
        );
        
        $builder->add(
            'email',
            EmailType::class,
            [
                'label' => 'E-mail',
                'required' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Введите E-mail'])
                ]
            ]
        );
        
        $builder->add(
            'is_active',
            CheckboxType::class,
            [
                'label' => 'Активен',
                'required' => false,
                'attr' => array(
                    'size' => '6',
                )
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
    
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }  
    
    public function getIsActive()
    {
        return $this->is_active;
    }

    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
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
