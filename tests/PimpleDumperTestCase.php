<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Test;

use Pimple\Container;

class PimpleDumperTestCase extends \PHPUnit_Framework_TestCase
{
    protected $actual;
    protected $expected;

    /** @var array */
    protected $contents;

    protected function setUp()
    {
        parent::setUp();

        $this->contents = array(
            'foo' => function () {
                return new \ArrayObject();
            },
            'bar' => function () {
                return false;
            },
            'baz' => 100,
            'hoge' => function () {
                $container = new Container();
                $container['fuga'] = 'piyo';
                return $container;
            },
        );
    }

    /**
     * @param string $message
     * @link http://objectclub.jp/community/memorial/homepage3.nifty.com/masarl/article/junit/scenario-based-testcase.html#verify%20%E3%83%A1%E3%82%BD%E3%83%83%E3%83%89
     */
    protected function verify($message = '')
    {
        $this->assertEquals($this->expected, $this->actual, $message);
    }
}