# Composer Inheritance Plugin

[![Package version](https://img.shields.io/packagist/vpre/theofidry/composer-inheritance-plugin.svg?style=flat-square)](https://packagist.org/packages/theofidry/composer-inheritance-plugin)
[![Build Status](https://travis-ci.org/theofidry/composer-inheritance-plugin.svg?branch=master)](https://travis-ci.org/theofidry/composer-inheritance-plugin)
[![License](https://img.shields.io/badge/license-MIT-red.svg?style=flat-square)](LICENSE)

Opinionated version of [Wikimedia composer-merge-plugin][1] to work in pair with [bamarni/composer-bin-plugin][2].


## Usage

If you are familiar with [bamarni/composer-bin-plugin][2], you know that you can
easily manage several namespaces without impacting your project dependencies.
There is however one issue: the `composer.json` files in your `vendor-bin`
directory are completely isolated from your project root `composer.json`. It is
possible thanks to [wikimedia/composer-merge-plugin][1] to change that. This
library pre-configure this plugin to work more nicely out of the box.

Live example: https://github.com/nelmio/alice

```
/nelmio-alice-project
├── composer.json <-- uses bamarni/composer-bin-plugin to manage vendor-bin
├── composer.lock
├── vendor/
└── vendor-bin/
    ├── laravel
    |   ├── composer.json <-- uses theofidry/composer-inheritance-plugin to
    |   |                     inherit from the root `composer.json` and add
    |   |                     dependencies related to Laravel to test the
    |   |                     Laravel bridge
    |   ├── composer.lock
    |   └── vendor/
    └── symfony
        ├── composer.json <-- uses theofidry/composer-inheritance-plugin to
        |                     inherit from the root `composer.json` and add
        |                     dependencies related to Symfony to test the
        |                     Symfony bridge
        ├── composer.lock
        └── vendor/
```


[1]: https://github.com/wikimedia/composer-merge-plugin
[2]: https://github.com/bamarni/composer-bin-plugin
[3]: https://github.com/sensiolabs-de/deptrac
[4]: https://github.com/bobthecow/psysh
[5]: https://symfony.com
[6]: https://laravel.com
[7]: https://github.com/tommy-muehle/tooly-composer-script
[8]: https://phpunit.de/
