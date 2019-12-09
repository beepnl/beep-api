<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Device
 * @package App\Entity
 * @author George van Vliet
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="clazz", type="string")
 * @ORM\DiscriminatorMap({
 *      "FirstPartyDevice" = "FirstPartyDevice",
 *
 * })
 */
abstract class Device implements IdentifiableInterface
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sensor", mappedBy="device", orphanRemoval=true)
     */
    private $sensors;

    public function __construct()
    {
        $this->sensors = new ArrayCollection();
    }

    use IdentifiableTrait;

    /**
     * @return Collection|Sensor[]
     */
    public function getSensors(): Collection
    {
        return $this->sensors;
    }

    public function addSensor(Sensor $sensor): self
    {
        if (!$this->sensors->contains($sensor)) {
            $this->sensors[] = $sensor;
            $sensor->setDevice($this);
        }

        return $this;
    }

    public function removeSensor(Sensor $sensor): self
    {
        if ($this->sensors->contains($sensor)) {
            $this->sensors->removeElement($sensor);
            // set the owning side to null (unless already changed)
            if ($sensor->getDevice() === $this) {
                $sensor->setDevice(null);
            }
        }

        return $this;
    }
}
