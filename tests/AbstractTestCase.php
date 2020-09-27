<?php

namespace Antriver\EnergenieMihomeApiTests;

use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    protected function getTestCredentials(): array
    {
        $path = __DIR__.'/credentials.json';

        if (!file_exists($path)) {
            throw new \Exception("Please create the file tests/credentials.json with the values 'email' and 'password'.");
        }

        $json = file_get_contents($path);
        $credentials = json_decode($json, true);

        if (empty($credentials['email'])) {
            throw new \Exception("'email' is missing from the credentials file.");
        }

        if (empty($credentials['password'])) {
            throw new \Exception("'password' is missing from the credentials file.");
        }

        return $credentials;
    }
}
