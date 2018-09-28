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
        
        $this->actions['edit'] = [
                'title' => 'Edit',
                'route' => $this->action_route,
                'action' => 'edit',
                'field_id' => 'id',
                'icon' => 'fa fa-edit',
                'btntype' => 'btn-success',
                'onclick' => ''
        ];
        
        $this->buttons['add'] = [
            'title' => 'Add',
            'route' => $this->action_route,
            'action' => 'edit',
            'btnstyle' => 'btn btn-primary',
        ];
        
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
