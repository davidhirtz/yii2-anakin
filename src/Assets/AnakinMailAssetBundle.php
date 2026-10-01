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
    private string|null|false $absoluteLogoUrl = null;

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
        if ($this->absoluteLogoUrl === null) {
            $path = Yii::getAlias('@webroot') . self::MAIL_LOGO_URL;
            $url = $this->logoUrl ?? (file_exists($path) ? self::MAIL_LOGO_URL : parent::getLogoUrl());

            $this->absoluteLogoUrl = $url ? $this->getAbsoluteUrl($url) : false;
        }

        return $this->absoluteLogoUrl;
    }

    /**
     * The parent's property is private to it, so the mail bundle keeps the configured URL itself.
     */
    #[Override]
    public function setLogoUrl(string|false|null $logoUrl): void
    {
        $this->logoUrl = $logoUrl;
        $this->absoluteLogoUrl = null;
    }

    protected function getAbsoluteUrl(string $url): string|false
    {
        if (preg_match('#^([a-z][a-z0-9+.-]*:)?//#i', $url)) {
            return $url;
        }

        $hostInfo = $this->getHostInfo();
        return $hostInfo ? ($hostInfo . $url) : false;
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
