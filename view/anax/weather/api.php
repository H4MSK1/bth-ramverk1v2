<?php

namespace Anax\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$ipAddr = $di->get('request')->getServer('REMOTE_ADDR');
$userIp = ($ipAddr === '::1' ? '8.8.8.8' : $ipAddr);

?><h1>Weather forecast API</h1>

<pre>GET weather/api/forecast?type=[TYPE]&ip=[IP]</pre>
<pre>
    ?type=forecast - Retrieves the weather forecast
    ?type=history - Retrieves the weather forecast for the past 30 days
</pre>
<p>Test: <a href="<?= url('weather/api/forecast?type=forecast&ip=8.8.8.8') ?>">weather/api/forecast?type=forecast&ip=8.8.8.8</a></p>
<p>Example:</p>
<pre>GET weather/api/forecast?type=forecast&ip=8.8.8.8</pre>
<p>Results:</p>
<pre>
{
    "weather": [
        {
            "summary": "L\u00e4tt molnighet som startar under eftermiddagen.",
            "temperatureMin": -6.63,
            "temperatureMax": 7.24,
            "sunriseTime": "13:47",
            "sunsetTime": "23:22",
            "date": "2018-12-30"
        },
        {
            "summary": "Molnigt under dagen och m\u00e5ttlig vind som startar under eftermiddagen, forts\u00e4tter fram till kv\u00e4llen.",
            "temperatureMin": -5.54,
            "temperatureMax": 6.39,
            "sunriseTime": "13:47",
            "sunsetTime": "23:23",
            "date": "2018-12-31"
        }
        ...
    ]
}
</pre>

<pre>GET weather/api/forecast?type=[TYPE]&coords=[COORDINATES]</pre>
<pre>
    ?type=forecast - Retrieves the weather forecast
    ?type=history - Retrieves the weather forecast for the past 30 days
</pre>
<p>Test: <a href="<?= url('weather/api/forecast?type=forecast&coords=56.188784,15.5902514') ?>">weather/api/forecast?type=forecast&coords=56.188784,15.5902514</a></p>
<p>Example:</p>
<pre>GET weather/api/forecast?type=forecast&coords=56.188784,15.5902514</pre>
<p>Results:</p>
<pre>
{
    "weather": [
        {
            "summary": "Molnigt under dagen.",
            "temperatureMin": 0.38,
            "temperatureMax": 5.46,
            "sunriseTime": "07:31",
            "sunsetTime": "14:30",
            "date": "2018-12-29"
        },
        {
            "summary": "Molnigt under dagen.",
            "temperatureMin": -0.67,
            "temperatureMax": 6.16,
            "sunriseTime": "07:31",
            "sunsetTime": "14:32",
            "date": "2018-12-30"
        }
        ...
    ]
}
</pre>
