<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests\Modules\Admin\Widgets\Navs;

use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinLogo;
use Hirtz\Skeleton\Test\TestCase;
use Hirtz\Skeleton\Test\Traits\UserFixtureTrait;
use Yii;

class AnakinLogoTest extends TestCase
{
    use UserFixtureTrait;

    public function testTheLogoLinksToTheDashboard(): void
    {
        Yii::$app->getUser()->setIdentity($this->getUserFromFixture('admin'));

        self::assertStringContainsString('href="/admin/dashboard/index"', AnakinLogo::make()->render());
    }

    /**
     * A guest has no dashboard to be sent to, and the login page is where the logo already is.
     */
    public function testAGuestLogoHasNoLink(): void
    {
        self::assertStringContainsString('<a>', AnakinLogo::make()->render());
    }

    public function testTheDefinitionIsInlinedByDefault(): void
    {
        $html = AnakinLogo::make()->render();

        self::assertStringContainsString('<path id="anakin"', $html);
        self::assertStringContainsString('viewBox="0 0 888 137"', $html);
    }

    /**
     * A second logo on the same page references the path the first one defined rather than repeating it.
     */
    public function testTheDefinitionIsReferencedWithUseHref(): void
    {
        $html = AnakinLogo::make()
            ->useHref()
            ->render();

        self::assertStringContainsString('<use href="#anakin"/>', $html);
        self::assertStringNotContainsString('<path', $html);
    }
}
