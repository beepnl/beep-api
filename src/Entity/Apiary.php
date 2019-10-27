<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ApiaryRepository")
 */
class Apiary
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $roofed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoofed(): ?bool
    {
        return $this->roofed;
    }

    public function setRoofed(bool $roofed): self
    {
        $this->roofed = $roofed;

        return $this;
    }
}
