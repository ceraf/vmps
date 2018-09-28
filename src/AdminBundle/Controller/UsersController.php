<?php

namespace App\AdminBundle\Controller;

use App\Entity\User as Entity;
use App\AdminBundle\Form\UserForm as Form;
use App\AdminBundle\Grid\UserGrid as Grid;

use App\AdminBundle\Model\Controller\AdminController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\AdminBundle\Model\Event\UserEditListener;

class UsersController extends AdminController
{
    const HOME_ROUTE = 'admin_user_list';
    
    public function index(Request $request)
    {
		return $this->getGrid(Grid::class, Entity::class, $request);				
    }

	public function deleteAction($id, Request $request)
    {
        if ($this->getUser()->getId() != $id)
            return $this->redirect($this->generateUrl('index'));
        return $this->getFormAction($request)
                ->setEntity(Entity::class)
                ->setHomeRoute(self::HOME_ROUTE)
                ->execute('delete', ['id' => $request->get('delete_id')]);      
    }
    
	public function editAction($id, Request $request)
	{
        if ($id && ($this->getUser()->getId() != $id))
            return $this->redirect($this->generateUrl('index'));
		$listener = new UserEditListener($this->getUser(), $this->get('doctrine'));
        $this->dispatcher->addListener('action.add', array($listener, 'onAddHost'));
        return $this->getFormAction($request)
                ->setEntity(Entity::class)
                ->setForm(Form::class)
                ->setTitle(($id) ? 'Edit host' : 'Add host')
                ->setHomeRoute(self::HOME_ROUTE)
                ->execute('edit', ['id' => $id]);
    }
}
