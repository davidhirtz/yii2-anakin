<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests;

use Hirtz\Anakin\Bootstrap;
use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinAsideMenu;
use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinNavBar;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideMenu;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar;
use Hirtz\Skeleton\Test\TestCase;
use Yii;

class BootstrapTest extends TestCase
{
    public function testTheAliasesPointIntoTheBundle(): void
    {
        $basePath = dirname(__DIR__);

        self::assertEquals("$basePath/src", Yii::getAlias('@anakin'));
        self::assertFileExists(Yii::getAlias('@skeleton/../resources/mail/layouts/html') . '.php');
    }

    /**
     * The skeleton widgets are instantiated through the container, which is how the theme replaces them without a
     * project naming either class.
     */
    public function testTheNavWidgetsAreReplaced(): void
    {
        self::assertInstanceOf(AnakinNavBar::class, NavBar::make());
        self::assertInstanceOf(AnakinAsideMenu::class, AsideMenu::make());
    }

    public function testTheMessagesAreTranslated(): void
    {
        self::assertEquals('Need a hand?', Yii::t('anakin', 'ANAKIN_DASHBOARD_CONTACT'));
    }

    /**
     * Every default the bootstrap contributes is a `??=`, so a project keeps whatever it configured itself.
     */
    public function testTheProjectsOwnEmailSurvives(): void
    {
        self::assertEquals('test@test.localhost', Yii::$app->params['email']);
    }

    /**
     * The theme names the media module by id only, so without yii2-media it must not leave a module behind.
     */
    public function testTheMediaAvifQualityIsRaisedOnlyWithTheMediaBundle(): void
    {
        $modules = Yii::$app->getModules();

        if (!isset(Yii::$app->extensions['davidhirtz/yii2-media'])) {
            self::assertArrayNotHasKey('media', $modules);
            return;
        }

        $media = Yii::$app->getModule('media');
        self::assertNotNull($media);
        self::assertSame(Bootstrap::MEDIA_AVIF_QUALITY, $media->avifQuality ?? null);
    }

    public function testTheFaviconIsConfiguredOnTheAdminAssetBundle(): void
    {
        $bundle = Yii::$app->getAssetManager()->getBundle(AdminAssetBundle::class);

        self::assertInstanceOf(AdminAssetBundle::class, $bundle);
        self::assertEquals('/images/favicons/favicon.svg', $bundle->faviconOptions['href']);
    }
}
