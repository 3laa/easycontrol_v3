<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="shop_product")
 */
class Product extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     */
    private $brand;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Variant::class, inversedBy="products")
     */
    private $variant;

    /**
     * @ORM\OneToMany(targetEntity=ProductPhoto::class, mappedBy="product")
     */
    private $productPhotos;

    /**
     * @ORM\ManyToMany(targetEntity=PropertyOption::class, inversedBy="products")
     */
    private $propertyOption;



    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->productPhotos = new ArrayCollection();
        $this->propertyOption = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|ProductPhoto[]
     */
    public function getProductPhotos(): Collection
    {
        return $this->productPhotos;
    }

    public function addProductPhoto(ProductPhoto $productPhoto): self
    {
        if (!$this->productPhotos->contains($productPhoto)) {
            $this->productPhotos[] = $productPhoto;
            $productPhoto->setProduct($this);
        }

        return $this;
    }

    public function removeProductPhoto(ProductPhoto $productPhoto): self
    {
        if ($this->productPhotos->contains($productPhoto)) {
            $this->productPhotos->removeElement($productPhoto);
            // set the owning side to null (unless already changed)
            if ($productPhoto->getProduct() === $this) {
                $productPhoto->setProduct(null);
            }
        }

        return $this;
    }

    public function getVariant(): ?Variant
    {
        return $this->variant;
    }

    public function setVariant(?Variant $variant): self
    {
        $this->variant = $variant;

        return $this;
    }

    /**
     * @return Collection|PropertyOption[]
     */
    public function getPropertyOption(): Collection
    {
        return $this->propertyOption;
    }

    public function addPropertyOption(PropertyOption $propertyOption): self
    {
        if (!$this->propertyOption->contains($propertyOption)) {
            $this->propertyOption[] = $propertyOption;
        }

        return $this;
    }

    public function removePropertyOption(PropertyOption $propertyOption): self
    {
        if ($this->propertyOption->contains($propertyOption)) {
            $this->propertyOption->removeElement($propertyOption);
        }

        return $this;
    }
}
