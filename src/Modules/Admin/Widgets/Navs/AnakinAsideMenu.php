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
     * The skeleton renders no header at all, the pin having moved into the main menu — the row exists for a
     * theme with a logo of its own, which is this one.
     */
    #[Override]
    protected function getHeader(): ?Stringable
    {
        return Div::make()
            ->class('aside-header')
            ->content($this->getLogo());
    }

    protected function getLogo(): Stringable
    {
        return AnakinLogo::make()
            ->useHref();
    }
}
