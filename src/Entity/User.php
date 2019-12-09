<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @author George van Vliet
 *
 * @ORM\Entity
 */
class User implements UserInterface, IdentifiableInterface
{
    use IdentifiableTrait;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AccountMembership", mappedBy="user", orphanRemoval=true)
     */
    private $accountMemberships;

    /**
     * User constructor.
     * @param UuidInterface $id
     */
    public function __construct(UuidInterface $id = null)
    {
        $this->id = $id;
        $this->accountMemberships = new ArrayCollection();
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->id;
    }

    public function eraseCredentials()
    {

    }

    /**
     * @return Collection|AccountMembership[]
     */
    public function getAccountMemberships(): Collection
    {
        return $this->accountMemberships;
    }

    public function addAccountMembership(AccountMembership $accountMembership): self
    {
        if (!$this->accountMemberships->contains($accountMembership)) {
            $this->accountMemberships[] = $accountMembership;
            $accountMembership->setUser($this);
        }

        return $this;
    }

    public function removeAccountMembership(AccountMembership $accountMembership): self
    {
        if ($this->accountMemberships->contains($accountMembership)) {
            $this->accountMemberships->removeElement($accountMembership);
            // set the owning side to null (unless already changed)
            if ($accountMembership->getUser() === $this) {
                $accountMembership->setUser(null);
            }
        }

        return $this;
    }
}
