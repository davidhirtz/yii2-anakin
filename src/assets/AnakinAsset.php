<?php

declare(strict_types=1);

namespace Hirtz\Anakin\assets;

use Hirtz\Skeleton\assets\AdminAsset;
use Yii;
use yii\web\AssetBundle;

/**
 * AnakinAsset is the asset bundle for the Anakin admin theme.
 */
class AnakinAsset extends AssetBundle
{
    public const DEFAULT_LOGO_URL = '/images/admin/logo.svg';

    public $css = ['css/admin.min.css'];
    public $depends = [AdminAsset::class];
    public $sourcePath = '@anakin/assets/anakin';

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
