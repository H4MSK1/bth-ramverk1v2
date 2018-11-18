<?php

namespace Anax\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>IP Validator</h1>

<form method="post" action="">
    <fieldset>
        <input type="text" name="ip" placeholder="127.0.0.1">
        <input type="submit" value="Validate">
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
</table>

    <?php
}
