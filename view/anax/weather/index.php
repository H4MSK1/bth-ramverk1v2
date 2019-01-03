<?php

namespace Anax\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$ipAddr = $di->get('request')->getServer('REMOTE_ADDR');
$userIp = ($ipAddr === '::1' ? '8.8.8.8' : $ipAddr);

?><h1>Weather forecast</h1>

<form method="post" action="">
    <fieldset>
        <p>
            <label>Find location by IP-adress, example your ip (<?= $userIp ?>):</label>
            <br>
            <input type="text" name="ip" placeholder="8.8.8.8">
        </p>

        <p>
            <label>Find location coordinates (latitude, longitude), test coords (56.188784,15.5902514):</label>
            <br>
            <input type="text" name="coords" placeholder="56.188784,15.5902514">
        </p>

        <p>
            <input id="type-forecast" type="radio" name="type" value="forecast" checked>
            <label for="type-forecast">Forecast</label>
            <br>
            <input id="type-history" type="radio" name="type" value="history">
            <label for="type-history">History the past 30 days</label>
        </p>

        <p>
            <input type="submit" value="Submit">
        </p>
    </fieldset>
</form>

<?php if (isset($result) && count($result) > 0) : ?>
    <?php if (isset($result['error'])) : ?>
        <h2 style="color:red">Error: <?= $result['error'] ?></h2>
    <?php endif; ?>

    <?= $result['map'] ?>

    <?php foreach ($result['weather'] as $day) : ?>
        <h5><?= $day['date'] ?></h5>
        <table>
            <tr>
                <td>Summary:</td>
                <td><?= $day['summary'] ?></td>
            </tr>
            <tr>
                <td>Sunrise:</td>
                <td><?= $day['sunriseTime'] ?></td>
            </tr>
            <tr>
                <td>Sunset:</td>
                <td><?= $day['sunsetTime'] ?></td>
            </tr>
            <tr>
                <td>Min temperature:</td>
                <td><?= $day['temperatureMin'] ?> °C</td>
            </tr>
            <tr>
                <td>Max temperature:</td>
                <td><?= $day['temperatureMax'] ?> °C</td>
            </tr>
        </table>

    <?php endforeach; ?>

<?php endif;
