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
use App\Entity\Host as Entity;

class HostForm extends AbstractType
{
    protected $username;
    protected $mac;
    protected $categ;

	
    protected $formName = self::class;

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->options = $options;

        $builder->add(
            'username',
            TextType::class,
            [
                'label' => 'Name',
                'required' => true,
                'attr' => [
                    'bt_size' => '6'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Enter the user name'])
                ]
            ]
        );
        
        $builder->add(
            'categ',
            ChoiceType::class,
            [
                'attr' => [
                    'bt_size' => '6'
                ],
                'label' => 'Department',
                'required' => true,
                'choices'  => array(
                    'CB' => 'CB',
                    'OASU' => 'OASU',
                    'SSDTU' => 'SSDTU',
                    'Upr' => 'Upr',
                    'AHO' => 'AHO',
                    'SEO' => 'SEO',
                    'OKRiSR' => 'OKRiSR',
                    'OK' => 'OK',
                    'UO' => 'UO',
                    'SVK' => 'SVK',
                    'OKiD' => 'OKiD',
                    '1otd' => '1otd',
                    '2otd' => '2otd',
                    's/h' => 's/h',
                    'COTiZ' => 'COTiZ',
                    'FO' => 'FO',
                    'CPEO' => 'CPEO',
                    'AUCH' => 'AUCH',
                    'COMTS' => 'COMTS',
                    'SDTU' => 'SDTU',
                    'TTS' => 'TTS',
                    'SPR' => 'SPR',
                    'OKS' => 'OKS',
                    'TTRS' => 'TTRS',
                    'PTO' => 'PTO',
                    'OPR' => 'OPR',
                    'SES' => 'SES',
                    'OSR' => 'OSR',
                    'SNiTB' => 'SNiTB',
                    'Bufet' => 'Bufet',
                    'Zdrav' => 'Zdrav',
                    'UC' => 'UC',
                    'CDS' => 'CDS',
                    'RZA' => 'RZA',
                    'RZA_OLD' => 'RZA_OLD',
                    'CDTU' => 'CDTU',
                    'SNTB' => 'SNTB',
                    'GESR' => 'GESR',
                    'COKS' => 'COKS',
                )
            ]
        );  
        
        $builder->add(
            'mac',
            MacType::class,
            [
                'label' => 'Mac address',
                'required' => true,
                'attr' => [
                    'bt_size' => '12'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Enter the mac address'])
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
    
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
	
    public function getMac()
    {
        return $this->mac;
    }

    public function setMac($mac)
    {
        $this->mac = $mac;
    }
    
    public function getCateg()
    {
        return $this->categ;
    }

    public function setCateg($categ)
    {
        $this->categ = $categ;
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
