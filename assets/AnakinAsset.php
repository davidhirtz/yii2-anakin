<?php
namespace davidhirtz\yii2\anakin\assets;

use app\components\helpers\ArrayHelper;
use yii\web\AssetBundle;
use Yii;

/**
 * Class AnakinAsset.
 * @package davidhirtz\yii2\anakin\assets
 */
class AnakinAsset extends AssetBundle
{
	/**
	 * The default logo url.
	 */
	const DEFAULT_LOGO_URL='/images/admin/logo.svg';

	/**
	 * @var string
	 */
	public $sourcePath='@vendor/davidhirtz/yii2-anakin/assets/anakin';

	/**
	 * @var array
	 */
	public $css=[
		'css/app.min.css',
	];

	/**
	 * @var array
	 */
	public $depends=[
		'app\assets\AppAsset',
	];

	/**
	 * @var string
	 */
	protected $_logoUrl;

	/**
	 * Debug.
	 */
	public function init()
	{
		if(YII_DEBUG)
		{
			ArrayHelper::replaceValue($this->css, 'css/app.min.css', 'css/app.css');
			ArrayHelper::replaceValue($this->js, 'js/app.min.js', 'js/app.js');
		}

		parent::init();
	}


	/**
	 * @return false|string
	 */
	public function getLogoUrl()
	{
		if($this->_logoUrl===null)
		{
			$path=Yii::getAlias('@webroot').static::DEFAULT_LOGO_URL;
			$this->_logoUrl=file_exists($path) ? static::DEFAULT_LOGO_URL : false;
		}

		return $this->_logoUrl;
	}

	/**
	 * @param false|string $logoUrl
	 */
	public function setLogoUrl($logoUrl)
	{
		$this->_logoUrl=$logoUrl;
	}
}