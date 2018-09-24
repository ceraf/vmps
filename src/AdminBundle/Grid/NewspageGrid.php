<?php

namespace App\AdminBundle\Grid;

use App\AdminBundle\Model\Grid\Grid;

class NewspageGrid extends Grid
{
    protected function init()
    {
        $this->action_route = 'admin_newspage_action';
        $this->grid_route = 'admin_newspage_list';
        $this->title = 'News';
        
        parent::init();
        
        $this->fields = [
            'title' => [
                'name' => 'title',
                'label' => 'Название',
                'style' => ''
            ],
            'url' => [
                'name' => 'url',
                'label' => 'Ссылка',
                'style' => ''
            ],
            'categoryname' => [
                'name' => 'categoryname',
                'label' => 'Категория',
                'style' => ''
            ],
        ];
    }
}
