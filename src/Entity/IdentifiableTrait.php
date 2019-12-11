<?php

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Trait Identifiable
 * @package App\Entity
 * @author George van Vliet
 */
trait IdentifiableTrait
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
