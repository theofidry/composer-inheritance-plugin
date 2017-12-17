<?php

/*
 * This file is part of the Composer Inheritance plugin.
 *
 * Copyright (C) 2016 Théo FIDRY <theo.fidry@gmail.com>
 *
 * This software may be modified and distributed under the terms of the MIT
 * license. See the LICENSE file for details.
 */

require __DIR__.'/../fixtures/vendor/autoload.php';

\Acme\Application::salute();
echo PHP_EOL;
\Acme\DevApplication::salute();
echo PHP_EOL;
