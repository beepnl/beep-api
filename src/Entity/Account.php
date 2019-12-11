<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"account:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"account:write"}, "swagger_definition_name"="Write"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account extends Entity
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Apiary", mappedBy="account")
     * @ApiSubresource
     */
    private $apiaries;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AccountMembership", mappedBy="account", orphanRemoval=true)
     */
    private $accountMemberships;

    public function __construct(UuidInterface $id = null)
    {
        parent::__construct($id);

        $this->apiaries = new ArrayCollection();
        $this->accountMemberships = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Account
     */
    public function setName(string $name): Account
    {
        $this->name = $name;

        return $this;
    }

    public function getOwners()
    {
        return $this->accountMemberships->matching(Criteria::create()->andWhere(Criteria::expr()->eq('role', AccountMembership::ROLE_OWNER)));
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
}
