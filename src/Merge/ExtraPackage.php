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

use Fidry\Composer\InheritancePlugin\InheritancePlugin;
use Wikimedia\Composer\Merge\ExtraPackage as WikimediaExtraPackage;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
final class ExtraPackage extends WikimediaExtraPackage
{
    /**
     * @inheritdoc
     */
    protected function mergeOrDefer(
        $type,
        array $origin,
        array $merge,
        $state
    ) {
        unset($merge[InheritancePlugin::PACKAGE_NAME]);
        unset($merge['bamarni/composer-bin-plugin']);

        return parent::mergeOrDefer($type, $origin, $merge, $state);
    }

}
