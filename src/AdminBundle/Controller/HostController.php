<?php

namespace App\AdminBundle\Controller;

use App\Entity\Host as Entity;
use App\AdminBundle\Form\HostForm as Form;
use App\AdminBundle\Grid\HostGrid as Grid;

use App\AdminBundle\Model\Controller\AdminController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HostController extends AdminController
{
    const HOME_ROUTE = 'admin_host_list';
    
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
                ->setTitle(($id) ? 'Edit host' : 'Add host')
                ->setHomeRoute(self::HOME_ROUTE)
                ->execute('edit', ['id' => $id]);
    }
}
