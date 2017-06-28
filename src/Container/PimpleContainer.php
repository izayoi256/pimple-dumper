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

use Izayoi256\PimpleDumper\Parser\ParserInterface;

class PimpleContainer extends AbstractContainer implements \Iterator
{
    /**
     * {@inheritdoc}
     */
    public function __construct($container, ParserInterface $parser)
    {
        if (!($container instanceof \Pimple)) {
            throw new \InvalidArgumentException('Container must be instance of Pimple\Container.');
        }

        parent::__construct($container, $parser);
        $this->keys = $this->getContainer()->keys();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        $array = iterator_to_array($this);
        foreach ($array as &$element) {
            $element['value'] = ($element['value'] instanceof self) ?
                $element['value']->toArray() :
                $element['value'];
        }
        return array_values($array);
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->offsetGet($this->key());
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        next($this->keys);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return current($this->keys);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->offsetExists($this->key());
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        reset($this->keys);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($index)
    {
        return $this->getParser()->parse($index, $this->getContainer()->offsetGet($index));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return in_array($offset, $this->getContainer()->keys(), true);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException('Container cannot be overwritten.');
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException('Container cannot be overwritten.');
    }
}
