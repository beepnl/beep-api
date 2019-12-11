<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Account;
use App\Entity\FirstPartyDevice;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

/**
 * Class FirstPartyDeviceTest
 * @package App\Tests
 * @author George van Vliet
 */
class FirstPartyDeviceTest extends ApiTestCase
{
    use RefreshDatabaseTrait;

    public function testCreateFirstPartyDevice(): void
    {
        $this->bootKernel();
        $account = $this->findIriBy(Account::class, ['name' => 'personal account']);

        $response = static::createClient()->request('POST', '/first_party_devices', ['json' => [
            'account' => $account,
            'deviceId' => 'FAFAFA'
        ]]);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertRegExp('~^/first_party_devices/[0-9A-Fa-f-]{36}$~', $response->toArray()['@id']);
        $this->assertJsonContains([
            '@context' => '/contexts/FirstPartyDevice',
            '@type' => 'FirstPartyDevice',
            'deviceId' => 'FAFAFA',
            'account' => $account,
            'sensors' => []
        ]);
        $this->assertMatchesResourceItemJsonSchema(FirstPartyDevice::class);
    }
}
