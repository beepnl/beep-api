<?php

namespace App\Faker;

use Faker\Provider\Base;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidProvider
 * @package App\Faker
 * @author George van Vliet
 */
class UuidProvider extends Base
{
    public static function uuid() {
        return Uuid::uuid4();
    }
}
