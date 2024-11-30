<?php

declare(strict_types=1);

namespace davidhirtz\yii2\anakin\tests\unit;

use Codeception\Test\Unit;
use davidhirtz\yii2\anakin\assets\AnakinAsset;
use davidhirtz\yii2\skeleton\assets\AdminAsset;
use davidhirtz\yii2\skeleton\codeception\traits\AssetDirectoryTrait;
use davidhirtz\yii2\skeleton\helpers\FileHelper;
use Yii;

class AnakinAssetTest extends Unit
{
    use AssetDirectoryTrait;

    public function testDefaultLogoUrl(): void
    {
        $asset = new AnakinAsset();
        $this->assertFalse($asset->getLogoUrl());

        $webroot = Yii::getAlias('@runtime/tests');
        FileHelper::createDirectory($webroot);

        $logo = $webroot . '/' . $asset::DEFAULT_LOGO_URL;
        FileHelper::createDirectory(dirname($logo));

        file_put_contents($logo, '');

        Yii::setAlias('@webroot', $webroot);

        $asset = new AnakinAsset();
        $this->assertEquals($asset::DEFAULT_LOGO_URL, $asset->getLogoUrl());

        FileHelper::removeDirectory($webroot);
    }

    public function testSetLogoUrl(): void
    {
        $asset = new AnakinAsset();
        $asset->setLogoUrl('/images/admin/logo.svg');
        $this->assertEquals('/images/admin/logo.svg', $asset->getLogoUrl());
    }

    public function testRegisteredAssets(): void
    {
        $this->createAssetDirectory();

        $view = Yii::$app->getView();
        AnakinAsset::register($view);

        $this->assertEmpty($view->assetBundles[AdminAsset::class]->css);
        $this->assertContains('css/admin.min.css', $view->assetBundles[AnakinAsset::class]->css);

        $this->removeAssetDirectory();
    }
}
