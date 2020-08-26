<?php

namespace App\Entity;

use App\Repository\BaseEntityRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseEntity
 * @package App\Entity
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
class BaseEntity
{
  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $name;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $createdAt;

  /**
   * @ORM\Column(type="datetime", nullable=true)
   */
  private $updatedAt;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(?string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getCreatedAt(): ?DateTimeInterface
  {
    return $this->createdAt;
  }

  public function setCreatedAt(?DateTimeInterface $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  public function getUpdatedAt(): ?DateTimeInterface
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(?DateTimeInterface $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  public function __toString()
  {
    return '' . $this->getName();
  }
}
