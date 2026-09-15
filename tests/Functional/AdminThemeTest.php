<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Tests\Functional;

use Hirtz\Skeleton\Test\TestCase;
use Hirtz\Skeleton\Test\Traits\FunctionalTestTrait;
use Hirtz\Skeleton\Test\Traits\UserFixtureTrait;
use Yii;

class AdminThemeTest extends TestCase
{
    use FunctionalTestTrait;
    use UserFixtureTrait;

    private const string URL = 'https://www.test.localhost/admin/account/login';

    public function testTheStylesheetAndFaviconAreRegistered(): void
    {
        $this->open(self::URL);

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('link[rel="stylesheet"][href$="/css/anakin.css"]');
        self::assertSelectorExists('link[rel="shortcut icon"][href="/images/favicons/favicon.svg"]');
    }

    /**
     * The navbar renders outside `#wrap`, so the definition it inlines survives every htmx swap and the aside can
     * reference it instead of repeating the path.
     */
    public function testTheLogoIsDefinedInTheNavbarAndReferencedInTheAside(): void
    {
        $this->open(self::URL);

        $navbar = self::$crawler->filter('.anakin-navbar')->html();
        $aside = self::$crawler->filter('.anakin-aside')->html();

        self::assertStringContainsString('<path id="anakin"', $navbar);
        self::assertStringContainsString('href="#anakin"', $aside);
        self::assertStringNotContainsString('<path id="anakin"', $aside);
    }

    /**
     * The theme replaces the skeleton's dashboard view through the `view.theme.pathMap`, which named a directory
     * that does not exist until 2026-09-15 — so nothing ever rendered this view and nothing noticed it was stale.
     */
    public function testTheDashboardRendersTheThemedView(): void
    {
        $user = $this->getUserFromFixture('admin');
        $this->assignAdminRole($user->id);

        Yii::$app->getUser()->login($user);
        $this->open('https://www.test.localhost/admin');

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('.home-welcome');
        self::assertSelectorTextContains('.home-welcome h1', $user->getUsername());
        self::assertSelectorExists('.dashboard');
    }
}
