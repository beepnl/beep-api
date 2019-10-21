<?php

namespace App\Security;

use phpseclib\Crypt\RSA;
use phpseclib\Math\BigInteger;

/**
 * Class JsonWebKeySet
 * @package App\Security
 * @author George van Vliet
 */
class JsonWebKeySet
{
    private $keys;

    /**
     * JsonWebKeySet constructor.
     * @param $keys
     */
    public function __construct(array $keys)
    {
        $this->keys = $keys;
    }

    public static function createFromJson($json)
    {
        $json = json_decode($json, true);
        $keys = [];
        foreach ($json['keys'] as $key) {
            $rsa = new RSA();
            $rsa->loadKey(
                [
                    'e' => new BigInteger(base64_decode($key['e']), 256),
                    'n' => new BigInteger(base64_decode(strtr($key['n'], '-_', '+/'), true), 256)
                ]
            );
            $keys[$key['kid']] = $rsa->getPublicKey();
        }

        return new static($keys);
    }

    public function getKeys()
    {
        return $this->keys;
    }
}
