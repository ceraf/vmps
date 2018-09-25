<?php

namespace App\AdminBundle\Model\Event;

use Symfony\Component\EventDispatcher\Event;

class ActionDeleteEvent extends Event
{
	const NAME = 'action.delete';
	
	protected $data;
	
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
