<?php

namespace davidhirtz\yii2\anakin\assets;

/**
 * Class AnakinMailAsset
 * @package davidhirtz\yii2\anakin\assets
 */
class AnakinMailAsset extends AnakinAsset
{
    /**
     * The default logo url.
     */
    public const DEFAULT_LOGO_URL = '/images/mail/logo.svg';

    /**
     * @var bool whether the Anakin logo should be displayed in the mail footer
     */
    public $showAnakinLogo = true;

    /**
     * @var string width of logo as CSS string
     */
    public $logoWidth = '250px';

    /**
     * Removes all Javascript or CSS files, we only need the asset path for
     * the published font.
     */
    public function init()
    {
        $this->css = $this->depends = $this->js = [];
        parent::init();
    }
}