<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

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
abstract class Device extends Entity
{
    /**
     * @var string $deviceId This is the identifier of the device. This identifier should not change during the lifetime of the device. It may be a string of up to 64 characters long
     * @ORM\Column(type="string", length=64)
     * @Groups({"device:read", "device:write"})
     */
    private $deviceId;
    /**
     * @var Collection|Sensor[]
     * @ORM\OneToMany(targetEntity="App\Entity\Sensor", mappedBy="device")
     * @Groups("device:read")
     */
    private $sensors;

    /**
     * @var Account
     * @ORM\ManyToOne(targetEntity="App\Entity\Account")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"device:read", "device:write"})
     */
    private $account;

    /**
     * Device constructor.
     * @param string $deviceId
     * @param UuidInterface|null $id
     */
    public function __construct(string $deviceId, UuidInterface $id = null)
    {
        parent::__construct($id);

        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    /**
     * @return Collection|Sensor[]
     */
    public function getSensors(): Collection
    {
        return $this->sensors;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @param Account $account
     * @return Device
     */
    public function setAccount(Account $account): Device
    {
        $this->account = $account;

        return $this;
    }






}
