<?php

namespace App\AdminBundle\Grid;

use App\AdminBundle\Model\Grid\Grid;

class HostGrid extends Grid
{
    protected function init()
    {
        $this->action_route = 'admin_host_action';
        $this->grid_route = 'admin_host_list';
        $this->title = 'Hosts';
        
        parent::init();
        
        $this->fields = [
            'id' => [
                'name' => 'id',
                'label' => '#',
                'style' => '',
                'sortable' => true
            ],
            'username' => [
                'name' => 'username',
                'label' => 'User Name',
                'style' => '',
                'sortable' => true
            ],
            'mac' => [
                'name' => 'mac',
                'label' => 'Mac',
                'style' => '',
                'sortable' => true
            ],
            'categ' => [
                'name' => 'categ',
                'label' => 'Department',
                'style' => '',
                'sortable' => true
            ],
        ];
    }
}
