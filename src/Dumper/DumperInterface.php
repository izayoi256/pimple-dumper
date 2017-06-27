<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Dumper;

use Izayoi256\PimpleDumper\Container\ContainerInterface;

interface DumperInterface
{
    /**
     * Dump mapping of container.
     *
     * @param ContainerInterface $container
     * @return mixed
     */
    public function dump(ContainerInterface $container);
}
