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
    /**
     * The default logo url.
     */
    public const DEFAULT_LOGO_URL = '/images/admin/logo.svg';

    /**
     * @var array
     */
    public $css = ['css/admin.min.css'];

    /**
     * @var array
     */
    public $depends = [AdminAsset::class];

    /**
     * @var array
     */
    public $publishOptions = [
        'except' => [
            'scss/',
        ],
    ];

    /**
     * @var string
     */
    public $sourcePath = '@vendor/davidhirtz/yii2-anakin/assets/anakin';

    /**
     * @var string|null
     */
    protected ?string $_logoUrl = null;

    /**
     * @return false|string
     */
    public function getLogoUrl(): string|false
    {
        if ($this->_logoUrl === null) {
            $path = Yii::getAlias('@webroot') . static::DEFAULT_LOGO_URL;
            $this->_logoUrl = file_exists($path) ? static::DEFAULT_LOGO_URL : false;
        }

        return $this->_logoUrl;
    }

    /**
     * @param string|false|null $logoUrl
     */
    public function setLogoUrl(string|false|null $logoUrl)
    {
        $this->_logoUrl = $logoUrl;
    }
}