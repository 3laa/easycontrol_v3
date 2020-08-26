<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageRepository::class)
 * @ORM\Table(name="website_page")
 */
class Page extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Website::class, inversedBy="pages")
     */
    private $website;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class, inversedBy="pages")
     */
    private $page;

    /**
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="page")
     */
    private $pages;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebsite(): ?Website
    {
        return $this->website;
    }

    public function setWebsite(?Website $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getPage(): ?self
    {
        return $this->page;
    }

    public function setPage(?self $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(self $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setPage($this);
        }

        return $this;
    }

    public function removePage(self $page): self
    {
        if ($this->pages->contains($page)) {
            $this->pages->removeElement($page);
            // set the owning side to null (unless already changed)
            if ($page->getPage() === $this) {
                $page->setPage(null);
            }
        }

        return $this;
    }
}
