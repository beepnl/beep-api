<?php

namespace App\Entity;

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
     * User constructor.
     * @param UuidInterface $id
     */
    public function __construct(UuidInterface $id = null)
    {
        $this->id = $id;
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
}
