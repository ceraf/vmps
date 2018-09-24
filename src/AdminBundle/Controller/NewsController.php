<?php

namespace App\AdminBundle\Controller;

use App\Entity\Newspage as Entity;
use App\AdminBundle\Form\NewspageForm as Form;
use App\AdminBundle\Grid\NewspageGrid as Grid;

use App\AdminBundle\Model\Controller\AdminController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NewsController extends AdminController
{
    const HOME_ROUTE = 'admin_newspage_list';
    
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
