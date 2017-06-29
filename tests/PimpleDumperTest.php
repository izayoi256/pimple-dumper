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

use Izayoi256\PimpleDumper\PimpleDumper;
use Pimple\Container;

class PimpleDumperTest extends PimpleDumperTestCase
{
    /** @var string */
    protected $dst;

    protected function setUp()
    {
        parent::setUp();

        $this->dst = realpath(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR . 'pimple.json';
        if (file_exists($this->dst)) {
            unlink($this->dst);
        }
    }

    protected function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->dst)) {
            unlink($this->dst);
        }
    }

    public function testRegister()
    {
        $this->assertFileNotExists($this->dst);
        $serviceProvider = new PimpleDumper();
        $container = new Container();
        $container->register($serviceProvider);
        $container['pimple_dumper.pimple_json.dirpath'] = dirname($this->dst);
        $serviceProvider->__destruct();
        $this->assertFileExists($this->dst);
    }
}