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
            'username' => [
                'name' => 'username',
                'label' => 'User Name',
                'style' => ''
            ],
            'mac' => [
                'name' => 'mac',
                'label' => 'Mac',
                'style' => ''
            ],
            'categ' => [
                'name' => 'categ',
                'label' => 'Department',
                'style' => ''
            ],
        ];
    }
}
