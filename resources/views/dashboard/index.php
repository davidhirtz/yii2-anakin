<?php

declare(strict_types=1);

/**
 * @see \Hirtz\Skeleton\Modules\Admin\Controllers\DashboardController::actionIndex()
 * @var View $this
 */

use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinDashboardLogo;
use Hirtz\Skeleton\Modules\Admin\Widgets\DirectoryAlert;
use Hirtz\Skeleton\Modules\Admin\Widgets\EnvironmentAlert;
use Hirtz\Skeleton\Modules\Admin\Widgets\MigrationAlert;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\DashboardHeader;
use Hirtz\Skeleton\Modules\Admin\Widgets\SentryAlert;
use Hirtz\Skeleton\Web\User;
use Hirtz\Skeleton\Web\View;
use Hirtz\Skeleton\Widgets\Panels\Dashboard;

$this->title(Yii::t('skeleton', 'DASHBOARD_NAV_ITEM_LABEL'));

echo DashboardHeader::make()
    ->title(Yii::t('anakin', 'ANAKIN_DASHBOARD_HEADER', [
        'user' => User::current()->identity->getUsername()
    ]))
    ->content(AnakinDashboardLogo::make());

echo MigrationAlert::make();
echo DirectoryAlert::make();
echo EnvironmentAlert::make();
echo SentryAlert::make();
echo Dashboard::make();
?>
<div class="container">
    <div class="card">
        <div class="card-body">
            <p class="strong"><?= Yii::t('anakin', 'ANAKIN_DASHBOARD_CONTACT'); ?></p>
            <p>
                <a href="mailto:hello@anakin.co">hello@anakin.co</a>
                <br> Daniel<a href="tel:491707731849">+49 170 773 1849</a>
            </p>
            <a href="https://www.anakin.co" class="home-anakin" target="_blank"></a>
        </div>
    </div>
</div>
