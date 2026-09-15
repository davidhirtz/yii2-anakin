<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Modules\Admin\Widgets\Navs;

use Hirtz\Skeleton\Html\Aside;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideMenu;
use Stringable;

class AnakinAsideMenu extends AsideMenu
{
    protected function renderContent(): Stringable
    {
        return Aside::make()
            ->attributes($this->attributes)
            ->addClass('anakin-aside')
            ->content($this->getLogo(), $this->getMainMenu(), $this->getAccountMenu());
    }

    protected function getLogo(): Stringable
    {
        return AnakinLogo::make()
            ->useHref();
    }
}
