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

abstract class AbstractContainer implements ContainerInterface
{
    /** @var mixed */
    private $container;

    /** @var ParserInterface */
    private $parser;

    /**
     * @param mixed $container
     * @param ParserInterface $parser
     */
    public function __construct($container, ParserInterface $parser)
    {
        $this->container = $container;
        $this->parser = $parser;
    }

    /**
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return ParserInterface
     */
    public function getParser()
    {
        return $this->parser;
    }
}
