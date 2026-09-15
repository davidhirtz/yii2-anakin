<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Assets;

use Override;
use Yii;
use yii\base\InvalidConfigException;

class AnakinMailAssetBundle extends AnakinAssetBundle
{
    final public const string MAIL_LOGO_URL = '/images/mail/logo.svg';

    public bool $showAnakinLogo = true;
    public string $logoWidth = '250px';

    private string|null|false $logoUrl = null;

    #[Override]
    public function init(): void
    {
        $this->css = [];
        $this->depends = [];
        $this->js = [];

        parent::init();
    }

    #[Override]
    public function getLogoUrl(): string|false
    {
        if ($this->logoUrl === null) {
            $path = Yii::getAlias('@webroot') . self::MAIL_LOGO_URL;
            $this->logoUrl = file_exists($path) ? self::MAIL_LOGO_URL : parent::getLogoUrl();

            if ($this->logoUrl) {
                $hostInfo = $this->getHostInfo();
                $this->logoUrl = $hostInfo ? ($hostInfo . $this->logoUrl) : false;
            }
        }

        return $this->logoUrl;
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
