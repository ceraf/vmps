<?php

namespace App\AdminBundle\Controller;

use App\Entity\Netlog as Entity;
use App\AdminBundle\Grid\NetlogGrid as Grid;

use App\AdminBundle\Model\Controller\AdminController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

 
class NetlogController extends AdminController
{
    const HOME_ROUTE = 'admin_netlog_list';
    
    public function index(Request $request)
    {
		return $this->getGrid(Grid::class, Entity::class, $request);				
    }
}
