<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"sensor:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"sensor:write"}, "swagger_definition_name"="Write"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SensorRepository")
 */
class Sensor implements IdentifiableInterface
{
    use IdentifiableTrait;

    /**
     * @var string
     * @ORM\Column(type="string", length=128)
     * @Groups("sensor:read")
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Device", inversedBy="sensors")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"sensor:read", "sensor:write"})
     */
    private $device;

    /**
     * Sensor constructor.
     * @param $device
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDevice(): Device
    {
        return $this->device;
    }



}
