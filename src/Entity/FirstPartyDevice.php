<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\FirstPartyDeviceRepository")
 */
class FirstPartyDevice extends Device
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $devEui;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appEui;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appKey;

    public function getDevEui(): ?string
    {
        return $this->devEui;
    }

    public function setDevEui(?string $devEui): self
    {
        $this->devEui = $devEui;

        return $this;
    }

    public function getAppEui(): ?string
    {
        return $this->appEui;
    }

    public function setAppEui(?string $appEui): self
    {
        $this->appEui = $appEui;

        return $this;
    }

    public function getAppKey(): ?string
    {
        return $this->appKey;
    }

    public function setAppKey(?string $appKey): self
    {
        $this->appKey = $appKey;

        return $this;
    }
}
