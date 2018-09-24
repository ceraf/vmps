<?php

namespace App\AdminBundle\Controller;

use App\Entity\Newscategory as Entity;
use App\AdminBundle\Form\CategorynewsForm as Form;
use App\AdminBundle\Grid\CategorynewsGrid as Grid;

use App\AdminBundle\Model\Controller\AdminController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class CategorynewsController extends AdminController
{
    const HOME_ROUTE = 'admin_category_news_list';
    
    public function index(Request $request)
    {
		return $this->getGrid(Grid::class, Entity::class, $request);				
    }

	public function deleteAction($id, Request $request)
    {
        return $this->getFormAction($request)
                ->setEntity(Entity::class)
                ->setHomeRoute(self::HOME_ROUTE)
                ->execute('delete', ['id' => $id]);      
    }
    
	public function editAction($id, Request $request)
	{
        return $this->getFormAction($request)
                ->setEntity(Entity::class)
                ->setForm(Form::class)
                ->setTitle(($id) ? 'Редактировать страницу' : 'Создать страницу')
                ->setHomeRoute(self::HOME_ROUTE)
                ->execute('edit', ['id' => $id]);
    }
}
