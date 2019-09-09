<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AccountManagement", mappedBy="account", cascade={"persist", "remove"})
     */
    private $accountManagement;

    public function __construct()
    {
        $this->accountManagement = new ArrayCollection();
    }

    /**
     * @return Collection|AccountManagement[]
     */
    public function getAccountManagement(): Collection
    {
        return $this->accountManagement;
    }

    /**
     * @param AccountManagement $accountManagement
     * @return Account
     */
    public function addAccountManagement(AccountManagement $accountManagement): self
    {
        if (!$this->accountManagement->contains($accountManagement)) {
            $this->accountManagement[] = $accountManagement;
            $accountManagement->setAccount($this);
        }

        return $this;
    }

    /**
     * @param AccountManagement $accountManagement
     * @return Account
     */
    public function removeAccountManagement(AccountManagement $accountManagement): self
    {
        if (!$this->accountManagement->contains($accountManagement)) {
            $this->accountManagement->removeElement($accountManagement);
            if ($accountManagement->getAccount() === null) {
                $accountManagement->setAccount(null);
            }
        }

        return $this;
    }

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

    public function updateFunds(float $money): self
    {
        $this->funds += $money;

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
