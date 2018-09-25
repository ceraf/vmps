<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vmps_log")
 * @ORM\Entity(repositoryClass="App\Repository\NetlogRepository")
 */
class Netlog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="item_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=18)
     */
    private $mac;

    /**
     * @ORM\Column(type="string", length=18)
     */
    private $vl_name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $ip;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $interface;

    /**
     * @ORM\Column(type="datetime", name="dt")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMac(): ?string
    {
        return $this->mac;
    }

    public function setMac(string $mac): self
    {
        $this->mac = $mac;

        return $this;
    }

    public function getVlName(): ?string
    {
        return $this->vl_name;
    }

    public function setVlName(string $vl_name): self
    {
        $this->vl_name = $vl_name;

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

    public function getInterface(): ?string
    {
        return $this->interface;
    }

    public function setInterface(string $interface): self
    {
        $this->interface = $interface;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
	
    public function getDt(): string
    {
        return $this->created_at->format('d.m.Y H:i'); 
    }
}
