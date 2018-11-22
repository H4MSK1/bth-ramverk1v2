<?php

return [
    "routes" => [
        [
            "info" => "Ip locator",
            "mount" => "iplocator/default",
            "handler" => "\H4MSK1\IpLocator\IpLocatorController",
        ],
        [
            "info" => "Ip locator JSON",
            "mount" => "iplocator/api",
            "handler" => "\H4MSK1\IpLocator\IpLocatorApiController",
        ],
    ]
];
