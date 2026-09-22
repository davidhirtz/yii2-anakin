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

    #[Override]
    protected function getHeader(): ?Stringable
    {
        return AnakinLogo::make()
            ->useHref();
    }
}
