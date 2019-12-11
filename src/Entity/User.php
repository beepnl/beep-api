<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * The id of this class is set to the "sub" property of the Cognito User that this User is associated with. This property
 * is immutable. When a "sub" is encountered in a JWT token during authentication, and no User is known for that "sub",
 * a new User is created with that "sub".
 *
 * @package App\Entity
 * @author George van Vliet
 *
 * @ApiResource
 * @ORM\Entity
 */
class User extends Entity implements UserInterface
{
    /**
     * @var Collection|AccountMembership[] $accountMemberships Represents account membership, for Users other than the
     *                                                         Account owner.
     * @ORM\OneToMany(targetEntity="App\Entity\AccountMembership", mappedBy="user", orphanRemoval=true)
     */
    private $accountMemberships;

    /**
     * @param UuidInterface $id The user id as used by AWS Cognito AKA sub(ject) in JWT spec.
     */
    public function __construct(UuidInterface $id = null)
    {
        parent::__construct($id);

        $this->accountMemberships = new ArrayCollection();
    }

    /**
     * @return string[]
     */
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

    public function getUsername(): string
    {
        return $this->getId()->toString();
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
