<?php

namespace App\HttpClient;

use App\Model\Device;
use App\Model\DeviceState;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HueClient
{
    private const BASE_URL = 'http://%s/api/%s';

    private HttpClientInterface $client;
    private SerializerInterface $serializer;
    private string $baseURL;

    public function __construct(HttpClientInterface $client, SerializerInterface $serializer, string $apiToken, string $bridgeIp)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->baseURL = sprintf(self::BASE_URL, $bridgeIp, $apiToken);
    }

    /**
     * @return array<string,Device>
     */
    public function getDeviceList(): array
    {
        $json = $this->client->request('GET', $this->baseURL.'/lights')->getContent();

        /** @var Device[] $devices */
        return $this->serializer->deserialize($json, 'App\Model\Device[]', 'json');
    }

    public function turnLightOn(int $deviceId): bool
    {
        return $this->turnLight($deviceId, DeviceState::ON);
    }

    public function turnLightOff(int $deviceId): bool
    {
        return $this->turnLight($deviceId, DeviceState::OFF);
    }

    private function turnLight(int $deviceId, bool $on): bool
    {
        $json = $this->client->request('PUT', sprintf($this->baseURL.'/lights/%d/state', $deviceId), [
            'json' => ['on' => $on],
        ])->toArray();

        $message = reset($json);

        if (isset($message['error'])) {
            throw new \Exception($message['error']['description'] ?? 'An error occurred');
        }

        return true;
    }
}
