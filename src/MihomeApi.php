<?php

namespace Antriver\EnergenieMihomeApi;

use Antriver\EnergenieMihomeApi\Entities\Subdevice;
use GuzzleHttp\Client;

class MihomeApi
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $apiBaseUrl = 'https://mihome4u.co.uk/api/v1/';

    /**
     * @param string $email Email address of your MiHome account.
     * @param string $password Password for your MiHome account.
     */
    public function __construct(
        string $email,
        string $password
    ) {
        $this->email = $email;
        $this->password = $password;

        $this->guzzleClient = new Client(
            [
                'base_uri' => $this->apiBaseUrl,
            ]
        );
    }

    /**
     * @return Subdevice[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listAllSubdevices(): array
    {
        $data = $this->sendRequest('subdevices/list');

        return array_map(
            function ($subdeviceData) {
                return new Subdevice($subdeviceData);
            },
            $data
        );
    }

    /**
     * @param int $subdeviceId
     *
     * @return Subdevice
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function powerOnSubdevice(int $subdeviceId): Subdevice
    {
        $data = $this->sendRequest('subdevices/power_on', ['id' => $subdeviceId]);

        return new Subdevice($data);
    }

    /**
     * @param int $subdeviceId
     *
     * @return Subdevice
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function powerOffSubdevice(int $subdeviceId): Subdevice
    {
        $data = $this->sendRequest('subdevices/power_off', ['id' => $subdeviceId]);

        return new Subdevice($data);
    }

    /**
     * @param string $endpoint
     * @param array $params
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest(string $endpoint, array $params = []): array
    {
        $query = [];
        if (!empty($params)) {
            $query['params'] = json_encode($params);
        }

        // Send a request to https://foo.com/api/test
        $body = (string) $this->guzzleClient
            ->request(
                'GET',
                $endpoint,
                [
                    'auth' => [
                        $this->email,
                        $this->password,
                    ],
                    'query' => $query,
                ]
            )
            ->getBody();

        $response = json_decode($body, true);

        return $response['data'];
    }
}
