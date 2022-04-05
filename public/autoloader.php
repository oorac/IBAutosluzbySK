<?php

/*  _____ _______         _                      _
 * |_   _|__   __|       | |                    | |
 *   | |    | |_ __   ___| |___      _____  _ __| | __  ___ ____
 *   | |    | | '_ \ / _ \ __\ \ /\ / / _ \| '__| |/ / / __|_  /
 *  _| |_   | | | | |  __/ |_ \ V  V / (_) | |  |   < | (__ / /
 * |_____|  |_|_| |_|\___|\__| \_/\_/ \___/|_|  |_|\_(_)___/___|
 *                                _
 *              ___ ___ ___ _____|_|_ _ _____
 *             | . |  _| -_|     | | | |     |  LICENCE
 *             |  _|_| |___|_|_|_|_|___|_|_|_|
 *             |_|
 *
 * IT ZPRAVODAJSTVÍ  <>  PROGRAMOVÁNÍ  <>  HW A SW  <>  KOMUNITA
 *
 * Tento zdrojový kód je součástí výukových seriálů na
 * IT sociální síti WWW.ITNETWORK.CZ
 *
 * Kód spadá pod licenci prémiového obsahu a vznikl díky podpoře
 * našich členů. Je určen pouze pro osobní užití a nesmí být šířen.
 */

require_once '../vendor/autoload.php';

function autoloader($class) {
    if (mb_strpos($class, '\\') === false && preg_match('/Helper$/', $class)) // Není v namespace a končí na Helper
        $class = 'app\\helpers\\' . $class;
    elseif (mb_strpos($class, 'App\\') !== false)
        $class = 'a' . ltrim($class, 'A'); // Změní App na app
    else
        $class = 'vendor\\' . $class;
    $path = str_replace('\\', '/', $class) . '.php';
    if (file_exists('../' . $path))
        include('../' . $path);
}

spl_autoload_register("autoloader");
