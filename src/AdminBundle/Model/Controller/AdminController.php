<?php

namespace App\AdminBundle\Model\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;

use App\AdminBundle\Model\Grid\Grid;
use App\AdminBundle\Model\Controller\Action as FormAction;

class AdminController extends Controller
{
	protected $dispatcher;
	
	public function __construct()
	{
		$this->dispatcher = new EventDispatcher();
	}
	
    public function rowact($id, $action, Request $request)
    {
        $method = $action . 'Action';
        return $this->$method($id, $request);
    }
    
	protected function getGrid($grid, $entity, Request $request)
	{
		$OGrid = (new $grid ($request, $this->container))
				->setEntity($entity);
		return $OGrid->getResponse();
	}
    
    protected function getFormAction(Request $request)
    {
        return (new FormAction($request, $this->container))
				->setDispatcher($this->dispatcher);
    }
}
