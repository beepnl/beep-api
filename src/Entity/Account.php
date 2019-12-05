<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account implements IdentifiableInterface
{
    use IdentifiableTrait;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Apiary", mappedBy="account")
     * @ApiSubresource
     */
    private $apiaries;

    public function __construct()
    {
        $this->apiaries = new ArrayCollection();
    }

    /**
     * @return Collection|Apiary[]
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
}
