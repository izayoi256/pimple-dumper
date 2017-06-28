<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Test\Parser;

use Izayoi256\PimpleDumper\Parser\PimpleParser;
use Izayoi256\PimpleDumper\Test\PimpleDumperTestCase;
use Pimple\Container;

class PimpleParserTest extends PimpleDumperTestCase
{
    /** @var PimpleParser */
    protected $parser;

    protected function setUp()
    {
        parent::setUp();
        $this->parser = new PimpleParser();
    }

    public function testParse_pimpleContainer()
    {
        $parsed = $this->parser->parse('hoge', new Container());
        $this->assertEquals('hoge', $parsed['name']);
        $this->assertEquals('container', $parsed['type']);
        $this->assertInstanceOf('Izayoi256\PimpleDumper\Container\PimpleContainer', $parsed['value']);
    }

    public function testParse_closure()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'closure',
            'value' => '',
        );
        $this->actual = $this->parser->parse('hoge', function (){});
        $this->verify();
    }

    public function testParse_class()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'class',
            'value' => 'ArrayObject',
        );
        $this->actual = $this->parser->parse('hoge', new \ArrayObject());
        $this->verify();
    }
}