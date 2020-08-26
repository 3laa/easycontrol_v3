<?php

namespace App\Entity;

use App\Repository\WebsiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebsiteRepository::class)
 */
class Website extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $host;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prefix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locale;

    /**
     * @ORM\OneToMany(targetEntity=Page::class, mappedBy="website")
     */
    private $pages;

    /**
     * @ORM\OneToOne(targetEntity=Page::class, cascade={"persist", "remove"})
     */
    private $mainMenu;

    /**
     * @ORM\OneToOne(targetEntity=Page::class, cascade={"persist", "remove"})
     */
    private $rootPage;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $language = [];

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(?string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(?string $prefix): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * @return Collection|Page[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setWebsite($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->contains($page)) {
            $this->pages->removeElement($page);
            // set the owning side to null (unless already changed)
            if ($page->getWebsite() === $this) {
                $page->setWebsite(null);
            }
        }

        return $this;
    }

    public function getMainMenu(): ?Page
    {
        return $this->mainMenu;
    }

    public function setMainMenu(?Page $mainMenu): self
    {
        $this->mainMenu = $mainMenu;

        return $this;
    }

    public function getRootPage(): ?Page
    {
        return $this->rootPage;
    }

    public function setRootPage(?Page $rootPage): self
    {
        $this->rootPage = $rootPage;

        return $this;
    }

    public function getLanguage(): ?array
    {
        return $this->language;
    }

    public function setLanguage(?array $language): self
    {
        $this->language = $language;

        return $this;
    }
}
