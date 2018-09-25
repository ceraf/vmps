<?php

namespace App\AdminBundle\Model\Event;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\Systemevent as Entity;


class HostEditListener 
{
    protected $username;
    protected $em;
    
    public function __construct($user = null, $doctrine)
    {
        $this->user = $user;
        $this->doctrine = $doctrine;
    }

    public function onEditHost(Event $event)
    {
        $mes = "User '".$this->user->getUsername()."' edit line #".$event->getData()->getId().": mac-address - ".$event->getData()->getMac().
                ", username - ".$event->getData()->getUsername().", department - ".$event->getData()->getCateg();
        $sysevent = new Entity();
        $sysevent->setUser($this->user)
                ->setCreatedAt(new \DateTime('now'))
                ->setMes($mes);
        $this->doctrine->getEntityManager()->persist($sysevent);
        $this->doctrine->getEntityManager()->flush();
    }
    
    public function onAddHost(Event $event)
    {
        $mes = "User '".$this->user->getUsername()."' add line #".$event->getData()->getId().": mac-address - ".$event->getData()->getMac().
                ", username - ".$event->getData()->getUsername().", department - ".$event->getData()->getCateg();
        $sysevent = new Entity();
        $sysevent->setUser($this->user)
                ->setCreatedAt(new \DateTime('now'))
                ->setMes($mes);
        $this->doctrine->getEntityManager()->persist($sysevent);
        $this->doctrine->getEntityManager()->flush();
    }
    
    public function onDeleteHost(Event $event)
    {
        $mes = "User '".$this->user->getUsername()."' delete line".$event->getData()->getId().": mac-address - ".$event->getData()->getMac().
                ", username - ".$event->getData()->getUsername().", department - ".$event->getData()->getCateg();
        $sysevent = new Entity();
        $sysevent->setUser($this->user)
                ->setCreatedAt(new \DateTime('now'))
                ->setMes($mes);
        $this->doctrine->getEntityManager()->persist($sysevent);
        $this->doctrine->getEntityManager()->flush();
    }
}
