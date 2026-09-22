<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Modules\Admin\Widgets\Navs;

use Hirtz\Skeleton\Html\A;
use Hirtz\Skeleton\Html\Div;
use Hirtz\Skeleton\Html\Svg;
use Hirtz\Skeleton\Widgets\Widget;
use Override;
use Stringable;

class AnakinLogo extends Widget
{
    protected bool $useHref = false;

    public function useHref(): static
    {
        $this->useHref = true;
        return $this;
    }

    #[Override]
    protected function renderContent(): string|Stringable
    {
        return Div::make()
            ->class('anakin-logo-wrap')
            ->content($this->getLink());
    }

    protected function getLogo(): ?Stringable
    {
        $content = !$this->useHref
            ? '<g id="anakin"><path class="fill-body-color" d="M30.333 0h15.645v12l-3 3.981V40H8.267L0 28.867V0z"/><g class="fill-body-bg"><path d="m10.533 5 5.533 12.733h-2.067l-.933-2h-5l-.867 2h-2.2zm1.667 8.8-1.667-3.867-1.6 3.867zM18.933 8.429C18.933 6.393 20.52 5 22.106 5c1.163 0 1.904.536 2.327 1.393l-.635.214c-.317-.643-.952-.964-1.692-.964-1.163 0-2.433 1.071-2.433 2.786 0 1.071.74 1.929 1.904 1.929.529 0 1.058-.214 1.481-.643l.529.429c-.635.643-1.375.857-2.115.857-1.481-.107-2.538-1.071-2.538-2.571Zm5.712 0C24.645 6.5 26.02 5 27.818 5c1.481 0 2.644.857 2.644 2.464 0 1.929-1.375 3.429-3.173 3.429-1.481 0-2.644-.857-2.644-2.464m5.077-.858c0-1.179-.846-1.929-1.904-1.929-1.269 0-2.433 1.179-2.433 2.786 0 1.179.846 1.929 1.904 1.929 1.269 0 2.433-1.179 2.433-2.786m4.442 3.215-.952-2.25h-1.163l-.529 2.25h-.74l1.269-5.679h2.115c.846 0 1.587.536 1.587 1.5 0 1.071-.74 1.821-1.798 1.929l1.058 2.25h-.846Zm-.529-2.893c.846 0 1.375-.536 1.375-1.286a.954.954 0 0 0-.952-.964h-1.375l-.529 2.143h1.481zm2.327 2.893 1.269-5.679h3.702l-.106.643h-2.962l-.423 1.821h2.856l-.106.643H37.23l-.423 1.929h2.962l-.106.643h-3.702ZM33.182 30.579 31 35h4.364zM34.546 28l3.455 7h-1.909l-2.545-5.066z"/></g></g>'
            : '<use href="#anakin"/>';

        return Svg::make()
            ->class('anakin-logo')
            ->content($content)
            ->viewBox('0 0 48 40');
    }

    protected function getLink(): ?Stringable
    {
        return A::make()
            ->href(!$this->webuser->getIsGuest() ? ['/admin/dashboard/index'] : null)
            ->content($this->getLogo());
    }
}
