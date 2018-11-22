<?php

namespace H4MSK1\IpLocator;

class IpStackApi
{
    private $endpoint = 'http://api.ipstack.com/';
    private $apiKey = 'f6bdb5ad74bd4538d0b3096a1533577a';

    public function fetch($ip)
    {
        $curl = curl_init("{$this->endpoint}{$ip}?access_key={$this->apiKey}");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);

        return $response;
    }
}
