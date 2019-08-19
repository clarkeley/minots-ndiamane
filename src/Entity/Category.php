<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Float_;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $totalWeight;

    /**
     * @ORM\Column(type="float")
     */
    private $totalVolume;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Products", mappedBy="category", cascade={"persist","remove"})
     */
    private $product;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    /**
     * @return Collection|Products[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    /**
     * @param Products $product
     * @return Category
     */
    public function addProduct(Products $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    /**
     * @param Products $product
     * @return Category
     */
    public function removeProduct(Products $product): self
    {
        if ($this->product->contains($product)) {
            $this->product->removeElement($product);
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTotalWeight(): ?float
    {
        return $this->totalWeight;
    }

    public function getDynamicTotalWeight(): ?float
    {
        $weight = 0;

        foreach ($this->getProduct() as $product){
            $weight += $product->getWeight();
        }
        return $weight;
    }

    public function setTotalWeight(float $totalWeight): self
    {
        $this->totalWeight = $totalWeight;

        return $this;
    }

    public function addTotalWeight(float $weight): self
    {
        $this->totalWeight += $weight;

        return $this;
    }

    public function getTotalVolume(): ?float
    {
        return $this->totalVolume;
    }

    public function setTotalVolume(float $totalVolume): self
    {
        $this->totalVolume = $totalVolume;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
