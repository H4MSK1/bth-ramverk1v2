<?php

namespace Anax\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>IP Validator API</h1>

<pre>GET ipvalidator/api/validate?ip=[IP]</pre>
<p>Test: <a href="<?= url('ipvalidator/api/validate?ip=8.8.8.8') ?>">ipvalidator/api/validate?ip=8.8.8.8</a></p>
<p>Example:</p>
<pre>GET ipvalidator/api/validate?ip=8.8.8.8</pre>
<p>Results:</p>
<pre>
{
    "ip": "8.8.8.8",
    "type": "IPv4",
    "hostname": "google-public-dns-a.google.com"
}
</pre>
