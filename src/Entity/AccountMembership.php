<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountMembershipRepository")
 *
 */
class AccountMembership extends Entity
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="accountMemberships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="accountMemberships")
     * @ORM\JoinColumn(nullable=false)
     */
    private $account;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    private $role;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    const ROLE_OWNER = 'owner';
    const ROLE_MANAGER = 'member';
    const ROLE_MEMBER = 'member';

    /**
     * AccountMembership constructor.
     * @param User $user
     * @param Account $account
     * @param string $role
     * @param UuidInterface|null $id
     */
    public function __construct(User $user, Account $account, string $role = self::ROLE_MEMBER, UuidInterface $id = null)
    {
        parent::__construct($id);

        $this->createdAt = DateTimeImmutable::createFromFormat('U', time());
        $this->user = $user;
        $this->account = $account;
        $this->role = $role;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
