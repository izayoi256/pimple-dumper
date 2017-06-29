# Installation

## Pimple 1.x

``` sh
$ composer require izayoi256/pimple-dumper "~1.0"
```

## Pimple 2.x|3.x

``` sh
$ composer require izayoi256/pimple-dumper "~2.0"
```

# Registration

## Pimple 1.x

``` php
$container = new Pimple();
$container['pimple_dumper'] = new Izayoi256\PimpleDumper\PimpleDumper($container);

// optional
$container['pimple_dumper.pimple_json.dirpath'] = realpath(__DIR__);
$container['pimple_dumper.pimple_json.filename'] = 'foo.json';
```

## Pimple 2.x|3.x

``` php
$container = new Pimple\Container();
$container->register(new Izayoi256\PimpleDumper\PimpleDumper());

// optional
$container['pimple_dumper.pimple_json.dirpath'] = realpath(__DIR__);
$container['pimple_dumper.pimple_json.filename'] = 'foo.json';
```

Dump file path is ```vendor/../pimple.json```.
You can change it by setting ```pimple_dumper.pimple_json.dirpath``` and ```pimple_dumper.pimple_json.filename```

# License

This software is released under the MIT License, please see the LICENSE file.