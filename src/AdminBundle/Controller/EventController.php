<?php

namespace App\AdminBundle\Controller;

use App\Entity\Systemevent as Entity;
use App\AdminBundle\Grid\EventGrid as Grid;

use App\AdminBundle\Model\Controller\AdminController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

 
class EventController extends AdminController
{
    const HOME_ROUTE = 'admin_event_list';
    
    public function index(Request $request)
    {
		return $this->getGrid(Grid::class, Entity::class, $request);				
    }
}
