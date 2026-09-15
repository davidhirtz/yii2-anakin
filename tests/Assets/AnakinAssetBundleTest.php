<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests\Assets;

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Anakin\Assets\AnakinMailAssetBundle;
use Hirtz\Skeleton\Helpers\FileHelper;
use Hirtz\Skeleton\Test\TestCase;
use Yii;

class AnakinAssetBundleTest extends TestCase
{
    /**
     * The logo is a project asset, so the dashboard has to cope with an installation that ships none.
     */
    public function testTheLogoUrlIsFalseWithoutAFile(): void
    {
        self::assertFalse($this->createBundle()->getLogoUrl());
    }

    public function testTheLogoUrlIsTheDefaultPathOnceTheFileExists(): void
    {
        $this->createLogo(AnakinAssetBundle::DEFAULT_LOGO_URL);

        self::assertEquals(AnakinAssetBundle::DEFAULT_LOGO_URL, $this->createBundle()->getLogoUrl());
    }

    public function testTheLogoUrlCanBeConfigured(): void
    {
        $bundle = $this->createBundle();
        $bundle->setLogoUrl('/images/own-logo.svg');

        self::assertEquals('/images/own-logo.svg', $bundle->getLogoUrl());
    }

    /**
     * A mail client loads no stylesheet, so the bundle ships none.
     */
    public function testTheMailBundleCarriesNoAssets(): void
    {
        $bundle = $this->createBundle(AnakinMailAssetBundle::class);

        self::assertEquals([], $bundle->css);
        self::assertEquals([], $bundle->js);
        self::assertEquals([], $bundle->depends);
        self::assertFalse($bundle->getLogoUrl());
    }

    /**
     * A mail is read away from the site, so its logo is absolute — and it falls back to the admin one where the
     * mail images ship none of their own.
     */
    public function testTheMailLogoUrlFallsBackToTheAdminLogo(): void
    {
        $this->createLogo(AnakinAssetBundle::DEFAULT_LOGO_URL);

        self::assertEquals(
            $this->getWebRequest()->getHostInfo() . AnakinAssetBundle::DEFAULT_LOGO_URL,
            $this->createBundle(AnakinMailAssetBundle::class)->getLogoUrl()
        );
    }

    public function testTheMailLogoUrlPrefersTheMailLogo(): void
    {
        $this->createLogo(AnakinAssetBundle::DEFAULT_LOGO_URL);
        $this->createLogo(AnakinMailAssetBundle::MAIL_LOGO_URL);

        self::assertEquals(
            $this->getWebRequest()->getHostInfo() . AnakinMailAssetBundle::MAIL_LOGO_URL,
            $this->createBundle(AnakinMailAssetBundle::class)->getLogoUrl()
        );
    }

    /**
     * @param class-string<AnakinAssetBundle> $class
     */
    private function createBundle(string $class = AnakinAssetBundle::class): AnakinAssetBundle
    {
        /** @var AnakinAssetBundle $bundle */
        $bundle = Yii::createObject($class);
        return $bundle;
    }

    private function createLogo(string $url): void
    {
        $path = Yii::getAlias('@webroot') . $url;

        FileHelper::createDirectory(dirname($path));
        file_put_contents($path, '<svg></svg>');
    }
}
