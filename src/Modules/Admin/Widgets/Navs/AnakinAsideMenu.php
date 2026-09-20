<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Modules\Admin\Widgets\Navs;

use Hirtz\Skeleton\Html\Div;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideMenu;
use Override;
use Stringable;

class AnakinAsideMenu extends AsideMenu
{
    /**
     * @var array<string, mixed>
     */
    public array $attributes = [
        'class' => 'aside anakin-aside',
        'id' => 'aside',
    ];

    /**
     * The logo shares the header row with the pin button, which is where the skeleton puts it too — so the
     * collapsed aside keeps one top edge whichever theme renders it.
     */
    #[Override]
    protected function getHeader(): ?Stringable
    {
        return Div::make()
            ->class('aside-header')
            ->content($this->getLogo(), $this->getPinButton());
    }

    protected function getLogo(): Stringable
    {
        return AnakinLogo::make()
            ->useHref();
    }
}
