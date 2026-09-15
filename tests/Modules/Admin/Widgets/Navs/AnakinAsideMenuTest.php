<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests\Modules\Admin\Widgets\Navs;

use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideMenu;
use Hirtz\Skeleton\Test\TestCase;
use Hirtz\Skeleton\Test\Traits\UserFixtureTrait;
use Yii;

class AnakinAsideMenuTest extends TestCase
{
    use UserFixtureTrait;

    public function testTheAsideReferencesTheLogoAndKeepsTheSkeletonMenus(): void
    {
        Yii::$app->getUser()->setIdentity($this->getUserFromFixture('admin'));

        $html = AsideMenu::make()->render();

        self::assertStringContainsString('class="aside hidden-empty anakin-aside"', $html);
        self::assertStringContainsString('<use href="#anakin"/>', $html);
        self::assertStringContainsString('class="aside-main aside-nav nav"', $html);
        self::assertStringContainsString('id="account-menu"', $html);
    }
}
