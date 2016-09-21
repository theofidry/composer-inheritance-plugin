# Composer Inheritance Plugin

[![Build Status](https://travis-ci.org/theofidry/composer-inheritance-plugin.svg?branch=master)](https://travis-ci.org/theofidry/composer-inheritance-plugin)

Opinionated version of [Wikimedia composer-merge-plugin][1] to work in pair with [bamarni/composer-bin-plugin][2].


## Usage

When developing a library or an application, you may need to rely on multiple testing frameworks, tools (e.g. 
[deptrac][3] or [psysh][4]) or different frameworks like [Symfony][5] or [Laravel][6] (to provide framework bridges for
example). Depending of the tools you are using, you may quickly have dependencies conflicts. To that problem you have
several solutions:

1. Not using the tool (KISS)
2. Use a PHAR
3. Use a tool like [composer-bin-plugin][2] to avoid any conflicts


2) is convenient and you have tools such as [tommy-muehle/tooly-composer-script][7] to keep track of them in your
`composer.json` without polluting your Git repository with a binary. However it has two limitations:

- You don't have any versioning out of the box: the vendor may provide one or depending of the tool it may not be an
issue
- PHARs should not be used if it is used to *execute* code, e.g. [PHPUnit][8]†.

>†: a PHAR is an extension used to easily package a PHP application/tool. However the dependencies bundled **are not
isolated**. It means that if a PHAR contains a `symfony/yaml 3.1` dependency but your project is using
`symfony/yaml 2.3` you may 1) not have any problem if you are lucky 2) An error at some point in your code 3) Weird
 bugs or silent failure. This is a PHP limitation: the only solution would be to *rewrite* the namespaces in the PHAR
 but node all code would be compatible with such practice.
 
 3) Is nice but provide a limitation as well. Let's take an example: you are developing a library `acme/lib` which has
 a Symfony and Laravel bridge (those two dependencies can't be installed together in certain versions). Let's assume you
 are using PHPUnit for your tests. A solution with [composer-bin-plugin][2] would be to:
 
1. Mark the Symfony and Laravel bridge related tests with respectively the `@group symfony` and `@group laravel` tags
2. Have a `phpunit.xml.dist` running all the tests excluding the groups `symfony` and `laravel`
3. Install [composer-bin-plugin][2] as a dev dependency: `$ composer require --dev bamarni/composer-bin-plugin:dev-master`
4. Have a `symfony` bin namespace (e.g. `$ composer bin symfony require symfony/symfony`)
5. Have a `laravel` bin namespace (e.g. `$ composer bin symfony require laravel/framework`)
6. Have respectively `phpunit_symfony.xml.dist` and `phpunit_laravel.xml.dist` running only tests tagged with the
`symfony` and `laravel` group name.
 
The issues you will encounter with this kind of setup are:

- The autoloading: you will need to autoload both `vendor/autoload.php` and
`vendor-bin/{symfony, laravel}/vendor/autoload.php`. But this brings the same potential dependency conflicts as when
using a PHAR as explained above.
- Your project dependencies are not taken into account

The solution to it is simple: use [Wikimedia Composer merge plugin][1]. You can indeed use it in your `symfony` and
`laravel` bin namespaces `composer.json` to *inherit* what you want from the root `composer.json`, namely the autoloads
and requires sections. Once done, your tests only need your bin namespaces `autoload.php` bootstrap files to run!

This is the best solution I found, but I was personally not very happy with the manual setup require when using
[Wikimedia Composer merge plugin][1] in this configuration. This is why I created this plugin to avoid *any*
configuration for this scenario: just require this plugin in your bin namespaces, e.g.
`$ composer bin symfony require theofidry/composer-inheritance-plugin` and you're done!


## License

Released under the [MIT License](LICENSE).


[1]: https://github.com/wikimedia/composer-merge-plugin
[2]: https://github.com/bamarni/composer-bin-plugin
[3]: https://github.com/sensiolabs-de/deptrac
[4]: https://github.com/bobthecow/psysh
[5]: https://symfony.com
[6]: https://laravel.com
[7]: https://github.com/tommy-muehle/tooly-composer-script
[8]: https://phpunit.de/
