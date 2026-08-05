<?php

declare(strict_types=1);

namespace LaminasTest\ApiTools\OAuth2\Adapter\Pdo;

class ClientCredentialsTest extends AbstractBaseTestCase
{
    public function testCheckClientCredentials(): void
    {
        $storage = $this->createStorage();
        if ($storage instanceof NullStorage) {
            $this->markTestSkipped('Skipped Storage: ' . $storage->getMessage());

            return;
        }

        // nonexistant client_id
        $pass = $storage->checkClientCredentials('fakeclient', 'testpass');
        $this->assertFalse($pass);

        // invalid password
        $pass = $storage->checkClientCredentials('testclient', 'invalidcredentials');
        $this->assertFalse($pass);

        // valid credentials
        $pass = $storage->checkClientCredentials('testclient', 'testpass');
        $this->assertTrue($pass);
    }
}
