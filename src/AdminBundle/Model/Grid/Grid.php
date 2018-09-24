<?php

namespace App\AdminBundle\Model\Grid;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait;
use Symfony\Component\HttpFoundation\Request;
use \stdClass;

abstract class Grid
{
    use ControllerTrait;
    
    const SESSION_COUNT_ITEMS = 'numitems';
    const SESSION_SORT_BY = 'sort_by';
    const SESSION_SORT_TYPE = 'sort_type';
    const DEFAULT_SORT = 'id';
    const DEFAULT_SORT_TYPE = 'ASC';
    
    private $session;
    protected $container;
    protected $entityname;
    protected $collection;
    protected $paginator;
    protected $fields;
    protected $actions;
    protected $buttons;
    protected $action_route;
    protected $grid_route;
    protected $title = 'Grid';
    protected $request;
    protected $itemsonpage = 20;
    protected $optnumpages = [20,50,100,200];
    protected $sortby;
    protected $sorttype;

    public function __construct (Request $request, $container)
    {
        $this->container = $container;
        $this->request = $request;
        $this->session = $request->getSession();
        $this->template = $this->get('templating');
        $this->itemsonpage = ($this->getGridSession(self::SESSION_COUNT_ITEMS)) ?? $this->itemsonpage;//($this->session->get((new \ReflectionClass($this))->getShortName().'_'.self::SESSION_COUNT_ITEMS)) ?? $this->itemsonpage;
        $this->init();
        return $this;
    }

    public function setEntity($entity)
    {
        $this->entityname = $entity;
        return $this;
    }
    
    public function getResponse()
    {
        if (!$this->collection)
            $this->fetch();
            
        return $this->render('@Admin/default/grid/grid.html.twig',
            [
                'rows' => $this->getCollection(),
                'paginator' => $this->paginator,
                'grid_route' => $this->grid_route,
                'fields' => $this->fields,
                'actions' => $this->actions,
                'buttons' => $this->buttons,
                'title' => $this->title,
                'sortby' => $this->sortby,
                'sorttype' => strtolower($this->sorttype),
            ]);
    }

	protected function getLayoutName()
	{
		return $this->container->getParameter('admin_layout');
	}
	
    protected function getCollection()
    {
        if (empty($this->collection))
            $this->fetch();
            
        return $this->collection;
    }
    
    protected function init()
    {
        $this->actions['edit'] = [
                'title' => 'Edit',
                'route' => $this->action_route,
                'action' => 'edit',
                'field_id' => 'id',
                'icon' => 'fa fa-edit',
                'btntype' => 'btn-success',
                'onclick' => ''
        ];
        $this->actions['delete'] = [
                'title' => 'Delete',
                'route' => $this->action_route,
                'action' => 'delete',
                'field_id' => 'id',
                'icon' => 'fa fa-trash-o',
                'btntype' => 'btn-danger',
                'onclick' => "return confirm('Действительно удалить?');"
        ];
        
        $this->buttons['add'] = [
            'title' => 'Add',
            'route' => $this->action_route,
            'action' => 'edit',
            'btnstyle' => 'btn btn-primary',
        ];
    }

    protected function getPaginator($p)
    {
        $count = ($this->request->get('page_count')) ?? null;
        if ($count && in_array($count, $this->optnumpages)) {
            $this->setGridSession(self::SESSION_COUNT_ITEMS, $count); //$this->session->set((new \ReflectionClass($this))->getShortName().'_'.self::SESSION_COUNT_ITEMS, $count);
            $this->itemsonpage = $count;
        }

            $total = $this->getDoctrine()
                ->getEntityManager()
                ->createQueryBuilder()
                ->select('count(p.id)')
                ->from($this->entityname,'p')
                ->getQuery()
                ->getSingleScalarResult(); 
        
        if (!$total)
            return null;
        
        $paginator = new stdClass;
        $paginator->total = $total;
        $paginator->optnumpages = $this->optnumpages;
        $paginator->currpage = $p;
        $paginator->numpages = ceil($paginator->total/$this->itemsonpage);
        $paginator->itemsonpage = $this->itemsonpage;
        $paginator->route = $this->grid_route;

        return $paginator;        
    }
    
    protected function getGridSession($name)
    {
        return $this->session->get((new \ReflectionClass($this))->getShortName().'_'.$name);
    }
    
    protected function setGridSession($name, $value)
    {
        $this->session->set((new \ReflectionClass($this))->getShortName().'_'.$name, $value);
        return $this;
    }
    
    protected function fetch()
    {
        $p = $this->request->get('p') ?? '0';
        $this->sortby = ($this->getGridSession('sort_by')) ?? self::DEFAULT_SORT;
        $this->sorttype = ($this->getGridSession('sort_type')) ?? self::DEFAULT_SORT_TYPE;
        if ($this->request->get('sort_by') &&
                in_array($this->request->get('sort_by'), array_keys($this->fields))) {
            if ($this->sortby == $this->request->get('sort_by'))
                $this->sorttype = ($this->sorttype == 'ASC') ? 'DESC' : 'ASC';       
            $this->sortby = $this->request->get('sort_by');
            $this->setGridSession(self::SESSION_SORT_BY, $this->sortby);
            $this->setGridSession(self::SESSION_SORT_TYPE, $this->sorttype);
        }
        
        try {
            $repository = $this->getDoctrine()
                            ->getRepository($this->entityname);
                            
            if (method_exists($repository, 'getByPage')) {
                $this->paginator = $this->getPaginator($p);
                $offset = $p*$this->itemsonpage;
                $this->collection = $repository->getByPage($this->entityname, $offset, 
                        $this->itemsonpage, $this->sortby, $this->sorttype);
                
            } else {
                $this->collection = $repository->findBy([]);
                $this->paginator = null;
            }
        } catch (Exception $e) {
            throw new Exception('Ошибка базы данных.');
        }
        return $this;
    }
}
