<?php

namespace App\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface UniversallyIdentifiable
 * @package App\Entity
 * @author George van Vliet
 */
interface UniversallyIdentifiableInterface extends IdentifiableInterface
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;
}
