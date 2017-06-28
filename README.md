# Installation

``` sh
$ composer require izayoi256/pimple-dumper "~1.0"
```

# Registration

``` php
$container = new Pimple();
$container['pimple_dumper'] = new PimpleDumper($container);

// optional
$container['pimple_dumper.pimple_json.dirpath'] = realpath(__DIR__);
$container['pimple_dumper.pimple_json.filename'] = 'foo.json';
```

Dump file path is ```vendor/../pimple.json```.
You can change it by setting ```pimple_dumper.pimple_json.dirpath``` and ```pimple_dumper.pimple_json.filename```

# License

This software is released under the MIT License, please see the LICENSE file.