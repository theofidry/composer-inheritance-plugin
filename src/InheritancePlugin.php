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

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Package\Package;
use Fidry\Composer\InheritancePlugin\Merge\PluginState;
use Wikimedia\Composer\Logger;
use Wikimedia\Composer\MergePlugin as WikimediaMergePlugin;

/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
final class InheritancePlugin extends WikimediaMergePlugin
{
    /**
     * @inheritdoc
     */
    const PACKAGE_NAME = 'theofidry/composer-inheritance-plugin';

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return parent::getSubscribedEvents();
    }

    /**
     * @inheritdoc
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->state = new PluginState($this->composer);
        $this->logger = new Logger('inheritance-plugin', $io);
    }

    /**
     * @inheritdoc
     */
    protected function mergeFiles(array $patterns, $required = false)
    {
        parent::mergeFiles($patterns, $required);

        $package = $this->composer->getPackage();
        if (false === $package instanceof Package) {
            return;
        }

        $devRequires = $package->getDevRequires();

        unset($devRequires['bamarni/composer-bin-plugin']);

        $package->setDevRequires($devRequires);

        $this->composer->setPackage($package);
    }
}
