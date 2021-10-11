<?php

/*
 * This file is part of the Composer Inheritance plugin.
 *
 * Copyright (C) 2016 Théo FIDRY <theo.fidry@gmail.com>
 *
 * This software may be modified and distributed under the terms of the MIT
 * license. See the LICENSE file for details.
 */

namespace Fidry\Composer\InheritancePlugin\Merge;

use Wikimedia\Composer\Merge\V2\PluginState as WikimediaPluginState;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
final class PluginState extends WikimediaPluginState
{
    /**
     * @inheritdoc
     */
    protected $recurse = false;

    /**
     * @inheritdoc
     */
    public function loadSettings()
    {
        $this->requires = array(
            '../../composer.json',
        );
    }
}
