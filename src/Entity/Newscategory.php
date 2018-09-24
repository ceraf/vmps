<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\AdminBundle\Model\BaseDBModel;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewscategoryRepository")
 */
class Newscategory implements BaseDBModel
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Newspage", mappedBy="category")
     */
    private $newspages;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $url;

    public function __construct()
    {
        $this->newspages = new ArrayCollection();
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

    /**
     * @return Collection|Newspage[]
     */
    public function getNewspages(): Collection
    {
        return $this->newspages;
    }

    public function addNewspage(Newspage $newspage): self
    {
        if (!$this->newspages->contains($newspage)) {
            $this->newspages[] = $newspage;
            $newspage->addCategory($this);
        }

        return $this;
    }

    public function removeNewspage(Newspage $newspage): self
    {
        if ($this->newspages->contains($newspage)) {
            $this->newspages->removeElement($newspage);
            $newspage->removeCategory($this);
        }

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
}
