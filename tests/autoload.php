<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$autoload = realpath('./vendor/autoload.php');

if (file_exists($autoload) && is_readable($autoload)) {
    require_once $autoload;
} else {
    die('Composer is not installed.');
}
