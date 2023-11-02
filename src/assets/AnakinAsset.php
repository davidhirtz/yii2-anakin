<?php

namespace davidhirtz\yii2\anakin\assets;

use davidhirtz\yii2\skeleton\assets\AdminAsset;
use yii\web\AssetBundle;
use Yii;

/**
 * AnakinAsset is the asset bundle for the Anakin admin theme.
 */
class AnakinAsset extends AssetBundle
{
    public const DEFAULT_LOGO_URL = '/images/admin/logo.svg';

    public $css = ['css/admin.min.css'];
    public $depends = [AdminAsset::class];

    public $publishOptions = [
        'except' => [
            'scss/',
        ],
    ];

    public $sourcePath = '@vendor/davidhirtz/yii2-anakin/src/assets/anakin';

    protected ?string $_logoUrl = null;

    public function getLogoUrl(): string|false
    {
        if ($this->_logoUrl === null) {
            $path = Yii::getAlias('@webroot') . static::DEFAULT_LOGO_URL;
            $this->_logoUrl = file_exists($path) ? static::DEFAULT_LOGO_URL : false;
        }

        return $this->_logoUrl;
    }

    /**
     * @noinspection PhpUnused
     */
    public function setLogoUrl(string|false|null $logoUrl): void
    {
        $this->_logoUrl = $logoUrl;
    }
}