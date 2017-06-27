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

use Izayoi256\PimpleDumper\Container\PimpleContainer;
use Pimple\Container;

class PimpleParser extends DefaultParser
{
    /**
     * {@inheritdoc}
     */
    public function parse($name, $element)
    {
        if (is_object($element) && $element instanceof Container) {
            return array(
                'name' => $name,
                'type' => 'container',
                'value' => new PimpleContainer($element, $this),
            );
        } else {
            return parent::parse($name, $element);
        }
    }
}
