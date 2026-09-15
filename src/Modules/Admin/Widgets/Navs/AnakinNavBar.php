<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Modules\Admin\Widgets\Navs;

use Hirtz\Skeleton\Html\Div;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\MainMenu;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar;
use Override;
use Stringable;

class AnakinNavBar extends NavBar
{
    #[Override]
    protected function renderContent(): Stringable|string
    {
        return Div::make()
            ->attributes($this->attributes)
            ->addClass('anakin-navbar navbar')
            ->content(AnakinLogo::make(), $this->getItems());
    }
}
