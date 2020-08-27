<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 * @ORM\Table(name="shop_property")
 */
class Property extends BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=PropertyOption::class, mappedBy="property")
     */
    private $propertyOptions;

    /**
     * @ORM\ManyToMany(targetEntity=Variant::class, inversedBy="properties")
     */
    private $variant;

    public function __construct()
    {
        $this->propertyOptions = new ArrayCollection();
        $this->variant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|PropertyOption[]
     */
    public function getPropertyOptions(): Collection
    {
        return $this->propertyOptions;
    }

    public function addPropertyOption(PropertyOption $propertyOption): self
    {
        if (!$this->propertyOptions->contains($propertyOption)) {
            $this->propertyOptions[] = $propertyOption;
            $propertyOption->setProperty($this);
        }

        return $this;
    }

    public function removePropertyOption(PropertyOption $propertyOption): self
    {
        if ($this->propertyOptions->contains($propertyOption)) {
            $this->propertyOptions->removeElement($propertyOption);
            // set the owning side to null (unless already changed)
            if ($propertyOption->getProperty() === $this) {
                $propertyOption->setProperty(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Variant[]
     */
    public function getVariant(): Collection
    {
        return $this->variant;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->variant->contains($variant)) {
            $this->variant[] = $variant;
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->variant->contains($variant)) {
            $this->variant->removeElement($variant);
        }

        return $this;
    }
}
