<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewspageRepository")
 */
class Newspage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $short_desct;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Newscategory", inversedBy="newspages")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $url;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDesct(): ?string
    {
        return $this->short_desct;
    }

    public function setShortDesct(string $short_desct): self
    {
        $this->short_desct = $short_desct;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Newscategory[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Newscategory $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Newscategory $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
    
    public function getSeoUrlKey()
    {
        return [
            'route' => self::class,
            'params' => ['id' => $this->getId()]
        ];
    }
    
    public function isHasSeoUrl()
    {
        return true;
    }
    
    public function getCategoryname()
    {
        return implode(',', array_map(function($item){return $item->getTitle();}, 
                $this->getcategory()->getValues()));
    }
}
