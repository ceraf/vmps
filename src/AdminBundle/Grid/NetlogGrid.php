<?php

namespace App\AdminBundle\Grid;

use App\AdminBundle\Model\Grid\Grid;

class NetlogGrid extends Grid
{
    protected function init()
    {
        $this->grid_route = 'admin_netlog_list';
        $this->title = 'Logs';
        

        
        $this->fields = [
            'dt' => [
                'name' => 'dt',
                'label' => 'Created',
                'style' => '',
                'sortable' => true
            ],   
            'mac' => [
                'name' => 'mac',
                'label' => 'Mac address',
                'style' => '',
                'sortable' => true
            ],

            'vlname' => [
                'name' => 'vlname',
                'label' => 'Vlan',
                'style' => '',
                'sortable' => true
            ],
			
            'ip' => [
                'name' => 'ip',
                'label' => 'Switch',
                'style' => '',
                'sortable' => true
            ],
			
            'interface' => [
                'name' => 'interface',
                'label' => 'Interface',
                'style' => '',
                'sortable' => true
            ],
        ];
    }
}
