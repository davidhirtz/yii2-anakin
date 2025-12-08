<?php

/**
 * @noinspection PhpUnused
 */

declare(strict_types=1);

namespace Hirtz\Anakin\tests\functional;

use Hirtz\Anakin\tests\support\FunctionalTester;
use Hirtz\Skeleton\codeception\fixtures\UserFixtureTrait;
use Hirtz\Skeleton\codeception\functional\BaseCest;
use Hirtz\Skeleton\models\User;
use Yii;

class AdminCest extends BaseCest
{
    use UserFixtureTrait;

    public function checkDashboard(FunctionalTester $I): void
    {
        $user = $this->getLoggedInUser();
        $this->assignUserRole($user->id);

        $I->amOnPage('/admin/dashboard/index');
        $I->seeLink("Skype with ANAKIN");
    }

    protected function assignUserRole(int $userId, string $role = User::AUTH_ROLE_ADMIN): void
    {
        $role = Yii::$app->getAuthManager()->getRole($role);
        Yii::$app->getAuthManager()->assign($role, $userId);
    }

    protected function getLoggedInUser(): User
    {
        $webuser = Yii::$app->getUser();
        $webuser->loginType = 'test';

        $user = User::find()->one();
        $webuser->login($user);

        return $user;
    }
}
