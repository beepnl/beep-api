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
 * @package App\Entity
 * @author George van Vliet
 *
 * @ApiResource
 * @ORM\Entity
 */
class User implements UserInterface, IdentifiableInterface
{
    use IdentifiableTrait;

    /**
     * @var string $sub The sub property of the Cognito User that this User is associated with. This property
     *                  is immutable. When a "sub" is encountered in a JWT token during authentication,
     *                  and no User is known for that "sub", a new User is created with that "sub".
     *
     * @ORM\Column(type="uuid", nullable=false)
     */
    private $sub;

    /**
     * @var Collection|AccountMembership[] $accountMemberships Represents account membership, for Users other than the
     *                                                         Account owner.
     * @ORM\OneToMany(targetEntity="App\Entity\AccountMembership", mappedBy="user", orphanRemoval=true)
     */
    private $accountMemberships;

    /**
     * @param UuidInterface $sub The user id as used by AWS Cognito AKA sub(ject) in JWT spec.
     */
    public function __construct(UuidInterface $sub)
    {
        $this->accountMemberships = new ArrayCollection();
        $this->sub = $sub;
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
