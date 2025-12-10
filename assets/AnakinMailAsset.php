<?php

declare(strict_types=1);

namespace Hirtz\Anakin\assets;

class AnakinMailAsset extends AnakinAsset
{
    public const DEFAULT_LOGO_URL = '/images/mail/logo.svg';

    /**
     * @var bool whether the Anakin logo should be displayed in the mail footer
     */
    public bool $showAnakinLogo = true;

    /**
     * @var string width of logo as CSS string
     */
    public string $logoWidth = '250px';

    /**
     * Removes all JavaScript and CSS files, we only need the asset path for the published font.
     */
    #[\Override]
    public function init(): void
    {
        $this->css = $this->depends = $this->js = [];
        parent::init();
    }
}
