<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Assets;

use Override;
use Yii;
use yii\base\InvalidConfigException;

class AnakinMailAssetBundleBundle extends AnakinAssetBundle
{
    public const string DEFAULT_LOGO_URL = '/images/mail/logo.svg';

    public bool $showAnakinLogo = true;

    public string $logoWidth = '250px';

    #[Override]
    public function init(): void
    {
        $this->css = [];
        $this->depends = [];
        $this->js = [];

        parent::init();
    }

    public function getHostInfo(): ?string
    {
        try {
            return Yii::$app->getUrlManager()->getHostInfo();
        } catch (InvalidConfigException) {
        }

        return null;
    }
}
