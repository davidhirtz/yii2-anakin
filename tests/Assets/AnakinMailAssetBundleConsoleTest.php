<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests\Assets;

use Hirtz\Anakin\Assets\AnakinMailAssetBundle;
use Hirtz\Skeleton\Console\Application;
use Hirtz\Skeleton\Helpers\FileHelper;
use Hirtz\Skeleton\Test\TestCase;
use Yii;

/**
 * A mail is sent from a command as well, where `UrlManager::getHostInfo()` throws rather than answering the host
 * — hence a case of its own rather than a method in {@see AnakinAssetBundleTest}.
 */
class AnakinMailAssetBundleConsoleTest extends TestCase
{
    protected string $applicationClass = Application::class;

    /**
     * A relative logo would resolve against the mail client, so the layout renders none at all.
     */
    public function testTheMailLogoUrlIsFalseWithoutAHost(): void
    {
        $path = Yii::getAlias('@webroot') . AnakinMailAssetBundle::MAIL_LOGO_URL;

        FileHelper::createDirectory(dirname($path));
        file_put_contents($path, '<svg></svg>');

        $bundle = Yii::createObject(AnakinMailAssetBundle::class);

        self::assertNull($bundle->getHostInfo());
        self::assertFalse($bundle->getLogoUrl());
    }
}
