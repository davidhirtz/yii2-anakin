<?php
declare(strict_types=1);

/**
 * @see DashboardController::actionIndex()
 * @var View $this
 * @var array $panels
 * @var AnakinAssetBundle $bundle
 */

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Skeleton\Modules\Admin\Controllers\DashboardController;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\DashboardHeader;
use Hirtz\Skeleton\Web\View;
use Hirtz\Skeleton\Widgets\Panels\Dashboard;

$bundle = $this->getAssetManager()->getBundle(AnakinAssetBundle::class);
$logoUrl = $bundle->getLogoUrl();

echo DashboardHeader::make();
echo Dashboard::make();
?>
<div class="text-center">
    <div class="home-wrap">
        <?php
        if ($logoUrl) {
            ?>
            <div class="home-logo">
                <img src="<?= $logoUrl; ?>" alt="<?= Yii::$app->name; ?>">
            </div>
            <?php
        } ?>
        <div class="home-welcome">
            <h1>
                <?= Yii::t('anakin', 'ANAKIN_DASHBOARD_GREETING', [
                    'name' => Yii::$app->getUser()->getIdentity()->getUsername(),
                ]); ?>
            </h1>
            <p>
                <?= Yii::t('anakin', 'ANAKIN_DASHBOARD_QUESTION'); ?>
            </p>
        </div>
    </div>
    <?php
    foreach ($panels as $panel) {
        ?>
        <?= Nav::widget([
            'items' => $panel['items'],
            'hideOneItem' => false,
            'options' => [
                'class' => 'home-nav',
            ],
        ]); ?>
        <?php
    }
?>
    <?= Nav::widget([
    'hideOneItem' => false,
    'items' => [
        [
            'label' => Yii::t('anakin', 'ANAKIN_DASHBOARD_SKYPE'),
            'url' => 'skype:danozzzz',
            'linkOptions' => [
                'id' => 'skype',
            ],
        ],
    ],
    'options' => [
        'class' => 'home-nav',
    ],
]); ?>
    <div class="home-footer">
        <p><?= Yii::t('anakin', 'ANAKIN_DASHBOARD_CONTACT'); ?></p>
        <p>
            <a href="mailto:hello@anakin.co">hello@anakin.co</a><br>
            Daniel <a href="tel:491707731849">+49 170 773 1849</a>
        </p>
        <a href="https://www.anakin.co" class="home-anakin" target="_blank"></a>
    </div>
</div>
