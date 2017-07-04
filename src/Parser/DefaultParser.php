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

class DefaultParser implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse($name, $element)
    {
        switch (true) {
            case is_object($element):
                if ($element instanceof \Closure) {
                    $type = 'closure';
                    $value = '';
                } else {
                    $type = 'class';
                    $value = get_class($element);
                }
                break;
            case is_string($element):
            case is_int($element):
            case is_bool($element):
                $type = gettype($element);
                $value = $element;
                break;
            case is_float($element):
                $type = 'float';
                $value = $element;
                break;
            case is_array($element):
                $type = gettype($element);
                $value = '';
                break;
            case is_null($element):
                $type = 'null';
                $value = '';
                break;
            default:
                $type = 'unknown';
                $value = gettype($element);
                break;
        }

        return compact('name', 'type', 'value');
    }
}
