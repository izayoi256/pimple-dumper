<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Container;

interface ContainerInterface
{
    /**
     * Transform this object to array.
     *
     * @return array
     */
    public function toArray();
}
