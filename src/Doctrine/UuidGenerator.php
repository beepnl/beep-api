<?php

namespace App\Doctrine;

use App\Entity\IdentifiableInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class UuidGenerator
 * @package App\Doctrine
 * @author George van Vliet
 */
class UuidGenerator extends AbstractIdGenerator
{
    /**
     * @param EntityManager $em
     * @param object|null $entity
     * @return UuidInterface
     * @throws Exception
     */
    public function generate(EntityManager $em, $entity)
    {
        $reflection = new \ReflectionClass($entity);
        $identifier = $reflection->getProperty('id');
        $identifier->setAccessible(true);
        $id = $identifier->getValue($entity);

        if (is_null($id)) {
            return Uuid::uuid4();
        } else {
            return $entity->getId();
        }
    }
}
