<?php

namespace App\AdminBundle\Grid;

use App\AdminBundle\Model\Grid\Grid;

class NasGrid extends Grid
{
    protected function init()
    {
        $this->action_route = 'admin_nas_action';
        $this->grid_route = 'admin_nas_list';
        $this->title = 'Switches';
        
        parent::init();
        
        $this->fields = [
            'id' => [
                'name' => 'id',
                'label' => '#',
                'style' => '',
                'sortable' => true
            ],
            'ip' => [
                'name' => 'ip',
                'label' => 'Ip',
                'style' => '',
                'sortable' => true
            ]
        ];
    }
}
