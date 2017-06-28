<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\ServiceProvider;

use Izayoi256\PimpleDumper\Container\PimpleContainer;
use Izayoi256\PimpleDumper\Dumper\PimpleJsonDumper;
use Izayoi256\PimpleDumper\Parser\PimpleParser;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PimpleDumperServiceProvider implements ServiceProviderInterface
{
    /** @var Container */
    protected $container;

    public function __destruct()
    {
        $this->container['pimple_dumper.dumper']->dump($this->container['pimple_dumper.container']);
    }

    public function register(Container $container)
    {
        $this->container = $container;

        $container['pimple_dumper.container'] = function ($container) {
            return new PimpleContainer($container, $container['pimple_dumper.parser']);
        };

        $container['pimple_dumper.parser'] = function ($container) {
            return new PimpleParser();
        };

        $container['pimple_dumper.dumper'] = function ($container) {
            return new PimpleJsonDumper($container['pimple_dumper.pimple_json.path']);
        };

        $container['pimple_dumper.pimple_json.path'] = function ($container) {
            return $container['pimple_dumper.pimple_json.dirpath'] . DIRECTORY_SEPARATOR . $container['pimple_dumper.pimple_json.filename'];
        };

        $container['pimple_dumper.pimple_json.dirpath'] = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
        $container['pimple_dumper.pimple_json.filename'] = 'pimple.json';
    }
}
