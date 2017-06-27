<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Test\Dumper;

use Izayoi256\PimpleDumper\Container\PimpleContainer;
use Izayoi256\PimpleDumper\Dumper\PimpleJsonDumper;
use Izayoi256\PimpleDumper\Parser\PimpleParser;
use Izayoi256\PimpleDumper\Test\PimpleDumperTestCase;
use Pimple\Container;

class PimpleJsonDumperTest extends PimpleDumperTestCase
{
    /** @var string */
    protected $src;

    /** @var string */
    protected $dst;

    /** @var PimpleJsonDumper */
    protected $dumper;

    /** @var PimpleContainer */
    protected $container;

    protected function setUp()
    {
        parent::setUp();

        $this->src = realpath(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'pimple.json';
        $this->dst = realpath(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR . 'pimple.json';

        if (file_exists($this->dst)) {
            unlink($this->dst);
        }

        $this->container = new PimpleContainer(new Container($this->contents), new PimpleParser());
        $this->dumper = new PimpleJsonDumper($this->dst);
    }

    protected function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->dst)) {
            unlink($this->dst);
        }
    }

    public function testDump()
    {
        $this->assertFileNotExists($this->dst);
        $this->dumper->dump($this->container);
        $this->assertFileExists($this->dst);
        $this->assertStringEqualsFile($this->dst, file_get_contents($this->src));
    }

    public function testDump_contentsAreIdentical()
    {
        $this->assertFileNotExists($this->dst);
        $this->dumper->dump($this->container);
        $oldMd5 = md5_file($this->dst);
        $this->dumper->dump($this->container);
        $newMd5 = md5_file($this->dst);

        $this->assertEquals($oldMd5, $newMd5);
    }

    public function testDump_overwrite()
    {
        $this->assertFileNotExists($this->dst);
        $this->dumper->dump($this->container);
        $oldMd5 = md5_file($this->dst);

        $container = new PimpleContainer(new Container(), new PimpleParser());
        $this->dumper->dump($container);
        $newMd5 = md5_file($this->dst);

        $this->assertNotEquals($oldMd5, $newMd5);
    }
}