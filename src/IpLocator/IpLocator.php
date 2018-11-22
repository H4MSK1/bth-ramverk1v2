<?php

namespace H4MSK1\IpLocator;

use H4MSK1\IpValidator\IpValidator;

class IpLocator
{
    private $api;
    private $validator;

    public function __construct($ipAddr = null)
    {
        $this->api = new IpStackApi();
        $this->validator = new IpValidator($ipAddr);
    }

    public function locateIp()
    {
        $payload = $this->validator->validate();

        if ($payload['ip'] === 'Invalid') {
            return $payload;
        }

        return $this->normalizeResponse($payload, $this->api->fetch($payload['ip']));
    }

    private function normalizeResponse($payload, $response)
    {
        $payload['longitude'] = $response['longitude'];
        $payload['latitude'] = $response['latitude'];
        $payload['country'] = $response['country_name'];
        $payload['city'] = $response['city'];

        return $payload;
    }
}
