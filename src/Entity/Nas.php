<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\AdminBundle\Model\BaseDBModel;

/**
 * @ORM\Table(name="vmps_nas")
 * @ORM\Entity(repositoryClass="App\Repository\NasRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Nas implements BaseDBModel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="nas_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $domain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }
    
    public function getSeoUrlKey()
    {
        return null;
    }
    
    public function isHasSeoUrl()
    {
        return false;
    }
    
    /**
     * @ORM\PrePersist  
     */
    public function preFlush()
    {
        $this->setName('ca_lan');
        $this->setDomain('lan.gomelenergo.net');
    }
}
