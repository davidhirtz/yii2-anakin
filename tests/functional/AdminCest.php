<?php

/**
 * @noinspection PhpUnused
 */

namespace davidhirtz\yii2\anakin\tests\functional;

use davidhirtz\yii2\anakin\tests\support\FunctionalTester;
use davidhirtz\yii2\anakin\tests\fixtures\UserFixture;
use davidhirtz\yii2\skeleton\db\Identity;
use davidhirtz\yii2\skeleton\models\User;
use Yii;

class AdminCest
{
    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ];
    }

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
        $user = Identity::find()->one();
        $user->loginType = 'test';

        Yii::$app->getUser()->login($user);
        return $user;
    }
}
