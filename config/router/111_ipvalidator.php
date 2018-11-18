<?php

return [
    "routes" => [
        [
            "info" => "Ip validator",
            "mount" => "ipvalidator/default",
            "handler" => "\H4MSK1\IpValidator\IpValidatorController",
        ],
        [
            "info" => "Ip validator JSON",
            "mount" => "ipvalidator/api",
            "handler" => "\H4MSK1\IpValidator\IpValidatorApiController",
        ],
    ]
];
