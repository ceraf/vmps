<?php

namespace App\AdminBundle\Controller;

use App\Entity\Nas as Entity;
use App\AdminBundle\Form\NasForm as Form;
use App\AdminBundle\Grid\NasGrid as Grid;

use App\AdminBundle\Model\Controller\AdminController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\EventDispatcher\Event;
use App\AdminBundle\Model\Event\NasEditListener;

class NasController extends AdminController
{
    const HOME_ROUTE = 'admin_nas_list';
    
    public function index(Request $request)
    {
		return $this->getGrid(Grid::class, Entity::class, $request);				
    }

	public function deleteAction($id, Request $request)
    {
		$listener = new NasEditListener($this->getUser(), $this->get('doctrine'));
        $this->dispatcher->addListener('action.delete', array($listener, 'onDeleteHost'));
        return $this->getFormAction($request)
                ->setEntity(Entity::class)
                ->setHomeRoute(self::HOME_ROUTE)
                ->execute('delete', ['id' => $request->get('delete_id')]);      
    }
    
	public function editAction($id, Request $request)
	{
		$listener = new NasEditListener($this->getUser(), $this->get('doctrine'));
        $this->dispatcher->addListener('action.edit', array($listener, 'onEditHost'));
        $this->dispatcher->addListener('action.add', array($listener, 'onAddHost'));
        return $this->getFormAction($request)
                ->setEntity(Entity::class)
                ->setForm(Form::class)
                ->setTitle(($id) ? 'Edit nas' : 'Add nas')
                ->setHomeRoute(self::HOME_ROUTE)
                ->execute('edit', ['id' => $id]);
    }
}
