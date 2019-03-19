<?php
namespace davidhirtz\yii2\anakin;

/**
 * Class AnakinMailAsset
 * @package davidhirtz\yii2\anakin
 */
class AnakinMailAsset extends AnakinAsset
{
    /**
     * The default logo url.
     */
    const DEFAULT_LOGO_URL='/images/mail/logo.svg';

    /**
     * Removes all Javascript or CSS files, we only need the asset path for
     * the published font.
     */
    public function init()
    {
        $this->css=$this->depends=$this->js=[];
        parent::init();
    }
}