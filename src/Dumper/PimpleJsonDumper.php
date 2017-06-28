<?php
/*
 * This file is part of the PimpleDumper package.
 *
 * (c) Shotaro Hama <qwert.izayoi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Izayoi256\PimpleDumper\Dumper;

use Izayoi256\PimpleDumper\Container\ContainerInterface;

class PimpleJsonDumper implements DumperInterface
{
    /** @var string */
    private $path;

    /**
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function dump(ContainerInterface $container)
    {
        $content = json_encode($container->toArray(), JSON_PRETTY_PRINT);

        if (file_exists($this->path)) {
            $oldContent = file_get_contents($this->path);
            if ($content === $oldContent) {
                return;
            }
        }

        file_put_contents($this->path, $content);
    }
}
