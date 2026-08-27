<?php

namespace Roundcube\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Entry point for the Roundcube plugin installer.
 *
 * Composer 1 allowed a package of type 'composer-installer' to name an
 * installer class directly in extra.class. Composer 2 removed that type, so
 * the entry point has to be a PluginInterface implementation that registers
 * the installer itself.
 *
 * @license GPL-3.0+
 */
class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getInstallationManager()->addInstaller(
            new PluginInstaller($io, $composer)
        );
    }

    /**
     * Required by Composer 2. The installer lives only for the duration of a
     * run and is discarded with the installation manager.
     */
    public function deactivate(Composer $composer, IOInterface $io)
    {
    }

    /**
     * Required by Composer 2. Plugin directories are removed by Composer
     * itself; no additional state is kept.
     */
    public function uninstall(Composer $composer, IOInterface $io)
    {
    }
}
