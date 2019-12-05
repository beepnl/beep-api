<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ApiaryRepository")
 */
class Apiary implements UniversallyIdentifiableInterface
{
    use IdentifiableTrait;

    /**
     * @ORM\Column(type="boolean")
     */
    private $roofed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", inversedBy="apiaries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $account;


    public function getRoofed(): ?bool
    {
        return $this->roofed;
    }

    public function setRoofed(bool $roofed): self
    {
        $this->roofed = $roofed;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }
}
