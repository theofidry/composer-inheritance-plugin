<?php

/*
 * This file is part of the Composer Inheritance plugin.
 *
 * Copyright (C) 2016 Théo FIDRY <theo.fidry@gmail.com>
 *
 * This software may be modified and distributed under the terms of the MIT
 * license. See the LICENSE file for details.
 */

namespace Fidry\Composer\InheritancePlugin;

use Wikimedia\Composer\MergePlugin as WikimediaMergePlugin;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
final class InheritancePlugin extends WikimediaMergePlugin
{
    /**
     * @inheritdoc
     */
    const PACKAGE_NAME = 'theofidryfidry/composer-inheritance-plugin';
}
