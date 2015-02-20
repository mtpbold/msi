<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Framework\App\View\Asset\MaterializationStrategy;

use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\View\Asset;

class Symlink implements StrategyInterface
{
    /**
     * Publish file
     *
     * @param WriteInterface $rootDir
     * @param WriteInterface $targetDir
     * @param $sourcePath
     * @param $destinationPath
     * @return bool
     */
    public function publishFile(
        WriteInterface $rootDir,
        WriteInterface $targetDir,
        $sourcePath,
        $destinationPath
    ) {
        return $rootDir->createSymlink($sourcePath, $destinationPath, $targetDir);
    }

    /**
     * Whether the strategy can be applied
     *
     * @param Asset\LocalInterface $asset
     * @return bool
     */
    public function isSupported(Asset\LocalInterface $asset)
    {
        $sourceParts = explode('/', $asset->getSourceFile());
        if (in_array(Asset\Source::TMP_MATERIALIZATION_DIR, $sourceParts)) {
            return false;
        }

        return true;
    }
}
