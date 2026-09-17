<?php

declare(strict_types=1);

/**
 * @see \Hirtz\Skeleton\Modules\Admin\Controllers\DashboardController::actionIndex()
 * @var View $this
 */

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Skeleton\Modules\Admin\Widgets\DirectoryAlert;
use Hirtz\Skeleton\Modules\Admin\Widgets\EnvironmentAlert;
use Hirtz\Skeleton\Modules\Admin\Widgets\MigrationAlert;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\DashboardHeader;
use Hirtz\Skeleton\Modules\Admin\Widgets\SentryAlert;
use Hirtz\Skeleton\Web\Application;
use Hirtz\Skeleton\Web\View;
use Hirtz\Skeleton\Widgets\Navs\Nav;
use Hirtz\Skeleton\Widgets\Navs\NavItem;
use Hirtz\Skeleton\Widgets\Panels\Dashboard;

$this->title(Yii::t('skeleton', 'DASHBOARD_NAV_ITEM_LABEL'));

/** @var AnakinAssetBundle $bundle */
$bundle = $this->getAssetManager()->getBundle(AnakinAssetBundle::class);
$logoUrl = $bundle->getLogoUrl();

echo DashboardHeader::make();
echo MigrationAlert::make();
echo DirectoryAlert::make();
echo EnvironmentAlert::make();
echo SentryAlert::make();
echo Dashboard::make();
?>
<div class="text-center">
    <div class="home-wrap">
        <?php if ($logoUrl) { ?>
            <div class="home-logo">
                <img src="<?= $logoUrl; ?>" alt="<?= Yii::$app->name; ?>">
            </div>
        <?php } ?>
        <div class="home-welcome">
            <h1>
                <?= Yii::t('anakin', 'ANAKIN_DASHBOARD_GREETING', [
                    'name' => Application::current()->getUser()->getIdentity()?->getUsername(),
                ]); ?>
            </h1>
            <p>
                <?= Yii::t('anakin', 'ANAKIN_DASHBOARD_QUESTION'); ?>
            </p>
        </div>
    </div>
    <?= Nav::make()
        ->class('home-nav')
        ->addItem(NavItem::make()
            ->label(Yii::t('anakin', 'ANAKIN_DASHBOARD_SKYPE'))
            ->url('skype:danozzzz')); ?>
    <div class="home-footer">
        <p><?= Yii::t('anakin', 'ANAKIN_DASHBOARD_CONTACT'); ?></p>
        <p>
            <a href="mailto:hello@anakin.co">hello@anakin.co</a><br>
            Daniel <a href="tel:491707731849">+49 170 773 1849</a>
        </p>
        <a href="https://www.anakin.co" class="home-anakin" target="_blank"></a>
    </div>
</div>
