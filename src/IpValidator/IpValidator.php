<?php

namespace H4MSK1\IpValidator;

class IpValidator
{
    private $ipAddr;
    private $payload = [];

    public function __construct($ipAddr = null)
    {
        $this->setIp($ipAddr);
    }

    public function setIp($ipAddr = null)
    {
        $this->ipAddr = empty($ipAddr) ? 'Invalid' : $ipAddr;

        return $this;
    }

    public function getIp()
    {
        return $this->ipAddr;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function validate()
    {
        $this->payload = [
            'ip' => $this->getIp(),
            'type' => $this->getProtocolType() ?: 'Invalid',
            'hostname' => $this->getHostName() ?: 'Unkown',
        ];

        return $this->payload;
    }

    public function getHostName()
    {
        // make sure we got a valid IP otherwise gethostbyaddr() throws an error
        if (! $this->getProtocolType()) {
            return false;
        }

        $ipAddr = $this->getIp();
        $host = gethostbyaddr($ipAddr);

        return $host === $ipAddr ? false : $host;
    }

    public function getProtocolType()
    {
        $ipAddr = $this->getIp();

        if (filter_var($ipAddr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return 'IPv4';
        } else if (filter_var($ipAddr, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return 'IPv6';
        }

        return false;
    }
}
