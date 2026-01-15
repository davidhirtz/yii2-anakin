<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Assets;

use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Yii;

/**
 * AnakinAsset is the asset bundle for the Anakin admin theme.
 */
class AnakinAssetBundle extends AdminAssetBundle
{
    public const DEFAULT_LOGO_URL = '/images/admin/logo.svg';

    public $css = ['css/admin.min.css'];
    public $depends = [AdminAssetBundle::class];
    public $js = [];
    public $sourcePath = '@anakin/../resources/assets/anakin';

    public $publishOptions = [
        'except' => [
            'scss/',
        ],
    ];

    protected string|null|false $_logoUrl = null;

    public function getLogoUrl(): string|false
    {
        if ($this->_logoUrl === null) {
            $path = Yii::getAlias('@webroot') . static::DEFAULT_LOGO_URL;
            $this->_logoUrl = file_exists($path) ? static::DEFAULT_LOGO_URL : false;
        }

        return $this->_logoUrl;
    }

    public function setLogoUrl(string|false|null $logoUrl): void
    {
        $this->_logoUrl = $logoUrl;
    }
}
