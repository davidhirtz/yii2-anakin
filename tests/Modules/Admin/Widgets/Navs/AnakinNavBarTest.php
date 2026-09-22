<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests\Modules\Admin\Widgets\Navs;

use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar;
use Hirtz\Skeleton\Test\TestCase;
use Hirtz\Skeleton\Test\Traits\UserFixtureTrait;

class AnakinNavBarTest extends TestCase
{
    use UserFixtureTrait;

    public function testTheNavbarCarriesTheLogoAndTheSkeletonItems(): void
    {
        $this->getWebUser()->setIdentity($this->getUserFromFixture('admin'));

        $html = NavBar::make()->render();

        self::assertStringContainsString('class="anakin-navbar navbar"', $html);
        self::assertStringContainsString('<g id="anakin"', $html);
        self::assertStringContainsString('class="navbar-search"', $html);
    }

    /**
     * The navbar survives every htmx swap while the id counter restarts on each request, so a generated id here
     * would sooner or later shadow the element of the same id in a later `#wrap`.
     */
    public function testTheNavbarCarriesNoGeneratedId(): void
    {
        $this->getWebUser()->setIdentity($this->getUserFromFixture('admin'));

        self::assertDoesNotMatchRegularExpression('/id="i\d+"/', NavBar::make()->render());
    }
}
