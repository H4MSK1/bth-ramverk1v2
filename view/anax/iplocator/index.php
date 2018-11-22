<?php

namespace Anax\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$ipAddr = $di->get('request')->getServer('REMOTE_ADDR');
$userIp = ($ipAddr === '::1' ? '8.8.8.8' : $ipAddr);

?><h1>IP Locator</h1>

<form method="post" action="">
    <fieldset>
        <input type="text" name="ip" placeholder="8.8.8.8" value="<?= $userIp ?>">
        <input type="submit" value="Locate IP">
    </fieldset>
</form>

<?php

if (isset($result) && count($result) > 0) {
    ?>

<table>
    <tr>
        <td>IP</td>
        <td><?= $result["ip"] ?></td>
    </tr>
    <tr>
        <td>Protocol</td>
        <td><?= $result["type"] ?></td>
    </tr>
    <tr>
        <td>Host</td>
        <td><?= $result["hostname"] ?></td>
    </tr>
    <tr>
        <td>Longitude</td>
        <td><?= $result["longitude"] ?? "Unkown" ?></td>
    </tr>
    <tr>
        <td>Latitude</td>
        <td><?= $result["latitude"] ?? "Unkown" ?></td>
    </tr>
    <tr>
        <td>Country</td>
        <td><?= $result["country"] ?? "Unkown" ?></td>
    </tr>
    <tr>
        <td>City</td>
        <td><?= $result["city"] ?? "Unkown" ?></td>
    </tr>
</table>

    <?php
}
