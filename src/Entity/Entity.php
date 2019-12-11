<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Entity
 * @package App\Entity
 * @author George van Vliet
 *
 * @ORM\MappedSuperclass
 */
abstract class Entity implements IdentifiableInterface
{
    /**
     * @var UuidInterface
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private $id;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function __construct(UuidInterface $uuid = null)
    {
        if ($uuid) {
            $this->id = $uuid;
        } else {
            $this->id = Uuid::uuid4();
        }
    }
}
