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

use Izayoi256\PimpleDumper\Parser\DefaultParser;
use Izayoi256\PimpleDumper\Test\PimpleDumperTestCase;
use Pimple\Container;

class DefaultParserTest extends PimpleDumperTestCase
{
    /** @var DefaultParser */
    protected $parser;

    protected function setUp()
    {
        parent::setUp();
        $this->parser = new DefaultParser();
    }

    public function testParse_pimpleContainer()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'class',
            'value' => 'Pimple\Container',
        );
        $this->actual = $this->parser->parse('hoge', new Container());
        $this->verify();
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

    public function testParse_array()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'array',
            'value' => '',
        );
        $this->actual = $this->parser->parse('hoge', array('fuga'));
        $this->verify();
    }

    public function testParse_string()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'string',
            'value' => 'fuga',
        );
        $this->actual = $this->parser->parse('hoge', 'fuga');
        $this->verify();
    }

    public function testParse_integer()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'integer',
            'value' => 100,
        );
        $this->actual = $this->parser->parse('hoge', 100);
        $this->verify();
    }

    public function testParse_float()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'float',
            'value' => 100.0,
        );
        $this->actual = $this->parser->parse('hoge', 100.0);
        $this->verify();
    }

    public function testParse_boolean()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'boolean',
            'value' => false,
        );
        $this->actual = $this->parser->parse('hoge', false);
        $this->verify();
    }

    public function testParse_null()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'NULL',
            'value' => null,
        );
        $this->actual = $this->parser->parse('hoge', null);
        $this->verify();
    }

    public function testParse_unknown()
    {
        $this->expected = array(
            'name' => 'hoge',
            'type' => 'unknown',
            'value' => 'resource',
        );
        $fp = fopen(__DIR__, 'r');
        $this->actual = $this->parser->parse('hoge', $fp);
        $this->verify();
        fclose($fp);
    }
}