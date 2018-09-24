<?php

namespace App\AdminBundle\Grid;

use App\AdminBundle\Model\Grid\Grid;

class CategorynewsGrid extends Grid
{
    protected function init()
    {
        $this->action_route = 'admin_category_news_action';
        $this->grid_route = 'admin_category_news_list';
        $this->title = 'Categories';
        
        parent::init();

        $this->fields = [
            'title' => [
                'name' => 'title',
                'label' => 'Name',
                'style' => ''
            ],
            'url' => [
                'name' => 'url',
                'label' => 'Url',
                'style' => ''
            ]
        ];
    }
}
