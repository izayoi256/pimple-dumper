<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Test\Container;

use Izayoi256\PimpleDumper\Container\PimpleContainer;
use Izayoi256\PimpleDumper\Parser\ParserInterface;
use Izayoi256\PimpleDumper\Parser\PimpleParser;
use Izayoi256\PimpleDumper\Test\PimpleDumperTestCase;

class PimpleContainerTest extends PimpleDumperTestCase
{
    /** @var \Pimple */
    protected $container;

    /** @var ParserInterface */
    protected $pimpleParser;

    protected function setUp()
    {
        parent::setUp();
        $this->container = new \Pimple($this->contents);
        $this->pimpleParser = new PimpleParser();
    }

    public function testConstruct_invalidArgument()
    {
        try {
            new PimpleContainer(array(), $this->pimpleParser);
            $this->fail();
        } catch (\InvalidArgumentException $e) {

        } catch (\Exception $e) {
            $this->fail();
        }
    }

    public function testToArray()
    {
        $container = new PimpleContainer($this->container, $this->pimpleParser);
        $expected = array(
            array(
                'name' => 'foo',
                'type' => 'class',
                'value' => 'ArrayObject',
            ),
            array(
                'name' => 'bar',
                'type' => 'boolean',
                'value' => false,
            ),
            array(
                'name' => 'baz',
                'type' => 'integer',
                'value' => 100,
            ),
            array(
                'name' => 'hoge',
                'type' => 'container',
                'value' => array(
                    array(
                        'name' => 'fuga',
                        'type' => 'string',
                        'value' => 'piyo',
                    )
                ),
            ),
        );

        $this->assertEquals($expected, $container->toArray());
    }

    public function testOffsetSet()
    {
        $container = new PimpleContainer($this->container, $this->pimpleParser);
        try {
            $container->offsetSet('piyo', 'baz');
            $this->fail();
        } catch (\BadMethodCallException $e) {

        } catch (\Exception $e) {
            $this->fail();
        }
    }

    public function testOffsetUnset()
    {
        $container = new PimpleContainer($this->container, $this->pimpleParser);
        try {
            $container->offsetUnset('piyo');
            $this->fail();
        } catch (\BadMethodCallException $e) {

        } catch (\Exception $e) {
            $this->fail();
        }
    }
}