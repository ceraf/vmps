<?php

namespace App\AdminBundle\Model\Event;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\Systemevent as Entity;


class NasEditListener 
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
        $mes = "User '".$this->user->getUsername()."' edit switch #".$event->getData()->getId().": ip - ".$event->getData()->getIp();
        $sysevent = new Entity();
        $sysevent->setUser($this->user)
                ->setCreatedAt(new \DateTime('now'))
                ->setMes($mes);
        $this->doctrine->getEntityManager()->persist($sysevent);
        $this->doctrine->getEntityManager()->flush();
    }
    
    public function onAddHost(Event $event)
    {
        $mes = "User '".$this->user->getUsername()."' add switch #".$event->getData()->getId().": ip - ".$event->getData()->getIp();
        $sysevent = new Entity();
        $sysevent->setUser($this->user)
                ->setCreatedAt(new \DateTime('now'))
                ->setMes($mes);
        $this->doctrine->getEntityManager()->persist($sysevent);
        $this->doctrine->getEntityManager()->flush();
    }
    
    public function onDeleteHost(Event $event)
    {
        $mes = "User '".$this->user->getUsername()."' delete switch".$event->getData()->getId().": ip - ".$event->getData()->getIp();
        $sysevent = new Entity();
        $sysevent->setUser($this->user)
                ->setCreatedAt(new \DateTime('now'))
                ->setMes($mes);
        $this->doctrine->getEntityManager()->persist($sysevent);
        $this->doctrine->getEntityManager()->flush();
    }
}
