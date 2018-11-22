<?php

namespace Anax\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$ipAddr = $di->get('request')->getServer('REMOTE_ADDR');
$userIp = ($ipAddr === '::1' ? '8.8.8.8' : $ipAddr);

?><h1>IP locator API</h1>

<pre>GET iplocator/api/locate?ip=[IP]</pre>
<p>Test: <a href="<?= url('iplocator/api/locate?ip=8.8.8.8') ?>">iplocator/api/locate?ip=8.8.8.8</a></p>
<p>Example:</p>
<pre>GET iplocator/api/locate?ip=8.8.8.8</pre>
<p>Results:</p>
<pre>
{
    "ip": "8.8.8.8",
    "type": "IPv4",
    "hostname": "google-public-dns-a.google.com",
    "longitude": -97.822,
    "latitude": 37.751,
    "country": "United States",
    "city": null
}
</pre>
<h2>Form</h2>
<form method="get" action="<?= url('iplocator/api/locate') ?>">
    <fieldset>
        <input type="text" name="ip" placeholder="8.8.8.8" value="<?= $userIp ?>">
        <input type="submit" value="Locate IP">
    </fieldset>
</form>
