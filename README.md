# Installation

``` sh
$ composer require izayoi256/pimple-dumper
```

# Registration

``` php
$container = new Pimple\Container();
$container->register(new Izayoi256\PimpleDumper\ServiceProvider\PimpleDumperServiceProvider());
```

Dump file path is ```vendor/../pimple.json```.
You can change it by setting ```pimple_dumper.pimple_json.dirpath``` and ```pimple_dumper.pimple_json.filename```

``` php
// optional
$container['pimple_dumper.pimple_json.dirpath'] = realpath(__DIR__);
$container['pimple_dumper.pimple_json.filename'] = 'foo.json';
```

# License

This software is released under the MIT License, please see the LICENSE file.