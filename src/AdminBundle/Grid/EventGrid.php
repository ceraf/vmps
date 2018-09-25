<?php

namespace App\AdminBundle\Grid;

use App\AdminBundle\Model\Grid\Grid;

class EventGrid extends Grid
{
    protected function init()
    {
        $this->grid_route = 'admin_event_list';
        $this->title = 'Events';
        

        
        $this->fields = [
            'created_at' => [
                'name' => 'dt',
                'label' => 'Created',
                'style' => '',
                'sortable' => true
            ],   
            'username' => [
                'name' => 'username',
                'label' => 'User Name',
                'style' => '',
                'sortable' => true
            ],

            'mes' => [
                'name' => 'mes',
                'label' => 'Event',
                'style' => '',
                'sortable' => true
            ],
        ];
    }
}
