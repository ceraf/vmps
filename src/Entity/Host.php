<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\AdminBundle\Model\BaseDBModel;

/**
 * @ORM\Table(name="vmps_items")
 * @ORM\Entity(repositoryClass="App\Repository\HostRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Host implements BaseDBModel
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
     * @ORM\Column(type="string", length=100)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $categ;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nas_name;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCateg(): ?string
    {
        return $this->categ;
    }

    public function setCateg(string $categ): self
    {
        $this->categ = $categ;
        $this->setVlName($this->getVlanManeByDep($categ));

        return $this;
    }

    public function getNasName(): ?string
    {
        return $this->nas_name;
    }

    public function setNasName(string $nas_name): self
    {
        $this->nas_name = $nas_name;

        return $this;
    }
    
    public function getVlanManeByDep($name): string
    {
        $data = [
            'CB' => 'FINANCE',
            'OASU' => 'OASU',
            'SSDTU' => 'SSDTU',
            'Upr' => 'VL4',
            'AHO' => 'VL1',
            'SEO' => 'VL9',
            'OKRiSR' => 'VL1',
            'OK' => 'VL1',
            'UO' => 'VL1',
            'SVK' => 'VL1',
            'OKiD' => 'VL1',
            '1otd' => 'VL1',
            '2otd' => 'VL1',
            's/h' => 'VL1',
            'COTiZ' => 'FINANCE',
            'FO' => 'FINANCE',
            'CPEO' => 'FINANCE',
            'AUCH' => 'VL1',
            'COMTS' => 'VL4',
            'SDTU' => 'VL4',
            'TTS' => 'VL8',
            'SPR' => 'VL8',
            'OKS' => 'VL8',
            'TTRS' => 'VL8',
            'PTO' => 'VL8',
            'OPR' => 'VL8',
            'SES' => 'VL9',
            'OSR' => 'VL9',
            'SNiTB' => 'VL9',
            'Bufet' => 'VL9',
            'Zdrav' => 'VL9',
            'UC' => 'UC',
            'CDS' => 'CDS',
            'RZA' => 'RZA',
            'RZA_OLD' => 'RZA_OLD',
            'CDTU' => 'VL4',
            'SNTB' => 'VL9',
            'GESR' => 'VL1',
            'COKS' => 'VL8',
        ];
        
        return $data[$name] ?? 'DENY';
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
        $this->setNasName('ca_lan');
    }
}
