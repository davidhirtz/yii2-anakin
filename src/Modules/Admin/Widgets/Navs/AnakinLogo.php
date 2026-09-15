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
            ->class('anakin-logo')
            ->content($this->getLink());
    }

    protected function getLogo(): ?Stringable
    {
        $content = !$this->useHref
            ? '<path id="anakin" d="M57.49.426L0 136.212h21.75l9.697-21.425h52.227l8.728 21.425h22.72L57.49.426zm0 52.782l16.625 41.005h-34.08l17.456-41.005zM261.413.85v77.19L208.63.85h-20.916v134.936h20.918V37.174l52.783 77.47v21.283h20.917V.85M410.06.426l-57.492 135.786h21.75l9.697-21.425h52.227l8.728 21.425h22.72L410.06.426zm-.14 52.782l16.763 41.005h-34.08l17.318-41.005zM609.548.85l-28.815 50.94-8.728 16.883-13.022 24.12V.852h-20.92v134.936h20.92L583.365 90.1l25.352 45.688h23.55l-36.71-66.97L633.096.85m69.684 134.936h20.088V.993H702.78M866.666.85v77.19L813.884.85h-20.918v134.936h20.918V37.174l52.782 77.47v21.283h20.918V.85"/>'
            : '<use href="#anakin"/>';

        return Svg::make()
            ->class('anakin-logo-img')
            ->content($content)
            ->viewBox('0 0 888 137');
    }

    protected function getLink(): ?Stringable
    {
        return A::make()
            ->href(!$this->webuser->getIsGuest() ? ['/admin/dashboard/index'] : null)
            ->content($this->getLogo());
    }
}
