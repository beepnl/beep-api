<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     denormalizationContext={"groups"={"first_party_device:write", "device:write"}, "swagger_definition_name"="Write"},
 *     normalizationContext={"groups"={"first_party_device:read", "device:read"}, "swagger_definition_name"="Read"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\FirstPartyDeviceRepository")
 */
class FirstPartyDevice extends Device
{

}
