<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $funds;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $updateBy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFunds(): ?float
    {
        return $this->funds;
    }

    public function setFunds(float $funds): self
    {
        $this->funds = $funds;

        return $this;
    }

    public function getUpdateBy(): ?string
    {
        return $this->updateBy;
    }

    public function setUpdateBy(string $updateBy): self
    {
        $this->updateBy = $updateBy;

        return $this;
    }

    public function __toString()
    {
        return $this->getUpdateBy();
    }
}
