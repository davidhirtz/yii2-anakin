<?php

namespace davidhirtz\yii2\anakin\assets;

use davidhirtz\yii2\skeleton\assets\AdminAsset;
use yii\web\AssetBundle;
use Yii;

/**
 * Class AnakinAsset
 * @package davidhirtz\yii2\anakin\assets
 */
class AnakinAsset extends AssetBundle
{
    /**
     * The default logo url.
     */
    public const DEFAULT_LOGO_URL = '/images/admin/logo.svg';

    /**
     * @var string
     */
    public $sourcePath = '@vendor/davidhirtz/yii2-anakin/assets/anakin';

    /**
     * @var array
     */
    public $css = [YII_DEBUG ? 'css/admin.css' : 'css/admin.min.css'];

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
    protected $_logoUrl;

    /**
     * @return false|string
     */
    public function getLogoUrl()
    {
        if ($this->_logoUrl === null) {
            $path = Yii::getAlias('@webroot') . static::DEFAULT_LOGO_URL;
            $this->_logoUrl = file_exists($path) ? static::DEFAULT_LOGO_URL : false;
        }

        return $this->_logoUrl;
    }

    /**
     * @param false|string $logoUrl
     */
    public function setLogoUrl($logoUrl)
    {
        $this->_logoUrl = $logoUrl;
    }
}