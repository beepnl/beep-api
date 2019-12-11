<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account extends Entity
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Apiary", mappedBy="account")
     * @ApiSubresource
     */
    private $apiaries;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AccountMembership", mappedBy="account", orphanRemoval=true)
     */
    private $accountMemberships;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    public function __construct(User $owner, UuidInterface $id = null)
    {
        parent::__construct($id);

        $this->apiaries = new ArrayCollection();
        $this->accountMemberships = new ArrayCollection();
        $this->owner = $owner;
    }

    /**
     * @return Collection|Apiary[]
     * @ApiSubresource
     */
    public function getApiaries(): Collection
    {
        return $this->apiaries;
    }

    public function addApiary(Apiary $apiary): self
    {
        if (!$this->apiaries->contains($apiary)) {
            $this->apiaries[] = $apiary;
            $apiary->setAccount($this);
        }

        return $this;
    }

    public function removeApiary(Apiary $apiary): self
    {
        if ($this->apiaries->contains($apiary)) {
            $this->apiaries->removeElement($apiary);
            // set the owning side to null (unless already changed)
            if ($apiary->getAccount() === $this) {
                $apiary->setAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AccountMembership[]
     */
    public function getAccountMemberships(): Collection
    {
        return $this->accountMemberships;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }
}
