<?php

namespace App\AdminBundle\Grid;

use App\AdminBundle\Model\Grid\Grid;

class UserGrid extends Grid
{
    protected function init()
    {
        $this->action_route = 'admin_user_action';
        $this->grid_route = 'admin_user_list';
        $this->title = 'Пользователи';
        
        parent::init();
        
        $this->fields = [
            'username' => [
                'name' => 'username',
                'label' => 'Имя',
                'style' => '',
                'sortable' => true
            ],
            'email' => [
                'name' => 'email',
                'label' => 'E-mail',
                'style' => '',
                'sortable' => true
            ]
        ];
    }
}
