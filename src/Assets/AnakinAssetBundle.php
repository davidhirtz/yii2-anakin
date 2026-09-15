<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Assets;

use Hirtz\Skeleton\Assets\AbstractAssetBundle;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Yii;

class AnakinAssetBundle extends AbstractAssetBundle
{
    private const string DEFAULT_LOGO_URL = '/images/admin/logo.svg';

    public $css = ['css/anakin.css'];
    public $depends = [AdminAssetBundle::class];
    public $sourcePath = '@anakin/../resources/assets/dist';

    private string|null|false $logoUrl = null;

    public function getLogoUrl(): string|false
    {
        if ($this->logoUrl === null) {
            $path = Yii::getAlias('@webroot') . self::DEFAULT_LOGO_URL;
            $this->logoUrl = file_exists($path) ? self::DEFAULT_LOGO_URL : false;
        }

        return $this->logoUrl;
    }

    public function setLogoUrl(string|false|null $logoUrl): void
    {
        $this->logoUrl = $logoUrl;
    }
}
