<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests\Modules\Admin\Widgets\Navs;

use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideMenu;
use Hirtz\Skeleton\Test\TestCase;
use Hirtz\Skeleton\Test\Traits\UserFixtureTrait;

class AnakinAsideMenuTest extends TestCase
{
    use UserFixtureTrait;

    public function testTheAsideReferencesTheLogoAndKeepsTheSkeletonMenus(): void
    {
        $this->getWebUser()->setIdentity($this->getUserFromFixture('admin'));

        $html = AsideMenu::make()->render();

        self::assertStringContainsString('class="aside anakin-aside"', $html);
        self::assertStringContainsString('<use href="#anakin"/>', $html);
        self::assertStringContainsString('class="aside-main aside-nav nav"', $html);
        self::assertStringContainsString('id="account-menu"', $html);
    }

    public function testTheLogoSharesTheHeaderRowWithThePinButton(): void
    {
        $this->getWebUser()->setIdentity($this->getUserFromFixture('admin'));

        $html = AsideMenu::make()->render();
        // Everything before the first list is the header, the menus being the only lists the aside renders.
        $header = substr($html, 0, (int)strpos($html, '<ul'));

        self::assertStringContainsString('aside-header', $header);
        self::assertStringContainsString('anakin-logo', $header);
        self::assertStringContainsString('data-aside-pin', $header);
    }

    public function testTheAsideIsLeftOutOfTheDocumentForAGuest(): void
    {
        self::assertSame('', AsideMenu::make()->render());
    }
}
