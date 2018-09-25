<?php

namespace App\AdminBundle\Model\Event;

use Symfony\Component\EventDispatcher\Event;

class ActionEditEvent extends Event
{
	const NAME = 'action.edit';
	
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
