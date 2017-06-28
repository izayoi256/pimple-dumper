<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Parser;

interface ParserInterface
{
    /**
     * Parse container element into mapping.
     *
     * @param string $name
     * @param mixed $element
     * @return array
     */
    public function parse($name, $element);
}
