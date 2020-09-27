<?php

namespace Antriver\EnergenieMihomeApiTests;

use Antriver\EnergenieMihomeApi\Entities\Subdevice;
use Antriver\EnergenieMihomeApi\MihomeApi;
use PHPUnit\Framework\TestCase;

class MihomeApiTest extends AbstractTestCase
{
    /**
     * @var MihomeApi
     */
    private $api;

    protected function setUp(): void
    {
        parent::setUp();

        $credentials = $this->getTestCredentials();
        $this->api = new MihomeApi($credentials['email'], $credentials['password']);
    }

    public function testListAllSubdevices()
    {
        $subdevices = $this->api->listAllSubdevices();

        print_r($subdevices);

        $this->assertNotEmpty($subdevices);
        $this->assertContainsOnlyInstancesOf(Subdevice::class, $subdevices);
    }

    public function testPowerOnSubdevice()
    {

    }
}
