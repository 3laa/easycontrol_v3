<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Category::class, cascade={"persist", "remove"})
     */
    private $mainCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vat;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $extraCurrency = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $exchangeRate = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $productNumberPrefix;

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="shop")
     */
    private $categories;



    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getVat(): ?int
    {
        return $this->vat;
    }

    public function setVat(?int $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    public function getExtraCurrency(): ?array
    {
        return $this->extraCurrency;
    }

    public function setExtraCurrency(?array $extraCurrency): self
    {
        $this->extraCurrency = $extraCurrency;

        return $this;
    }

    public function getExchangeRate(): ?array
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(?array $exchangeRate): self
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    public function getProductNumberPrefix(): ?string
    {
        return $this->productNumberPrefix;
    }

    public function setProductNumberPrefix(?string $productNumberPrefix): self
    {
        $this->productNumberPrefix = $productNumberPrefix;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setShop($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
            // set the owning side to null (unless already changed)
            if ($category->getShop() === $this) {
                $category->setShop(null);
            }
        }

        return $this;
    }

    public function getMainCategory(): ?Category
    {
        return $this->mainCategory;
    }

    public function setMainCategory(?Category $mainCategory): self
    {
        $this->mainCategory = $mainCategory;

        return $this;
    }
}
