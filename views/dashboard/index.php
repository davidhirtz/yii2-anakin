<?php
/**
 * Admin index for Anakin theme.
 * @see \davidhirtz\yii2\skeleton\modules\admin\controllers\DashboardController::actionIndex()
 * @var View $this
 * @var array $panels
 * @var AnakinAsset $bundle
 */

use davidhirtz\yii2\anakin\assets\AnakinAsset;
use davidhirtz\yii2\skeleton\web\View;
use davidhirtz\yii2\skeleton\widgets\fontawesome\Nav;

$bundle = $this->getAssetManager()->getBundle('\davidhirtz\yii2\anakin\assets\AnakinAsset');
$logoUrl = $bundle->getLogoUrl();

$this->registerJs('$("body").addClass("home");');
$this->registerCss('.breadcrumb{visibility:hidden;}');

$this->setTitle(Yii::t('skeleton', 'Admin'));
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
        }
        ?>
        <div class="home-welcome">
            <h1>
                <?= Yii::t('anakin', 'Hello {name}, good to', [
                    'name' => Yii::$app->getUser()->getIdentity()->getUsername(),
                ]); ?>
                <br>
                <?= Yii::t('anakin', 'have you back!'); ?>
            </h1>
            <p>
                <?= Yii::t('anakin', 'What do you want <br>to do today?'); ?>
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
            'items' => [
                [
                    'label' => Yii::t('anakin', 'Skype with ANAKIN'),
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
        <p><?= Yii::t('anakin', 'Need a hand?'); ?></p>
        <p>
            <a href="mailto:hello@anakin.co">hello@anakin.co</a><br>
            Daniel <a href="tel:491707731849">+49 170 773 1849</a>
        </p>
        <a href="https://www.anakin.co" class="home-anakin" target="_blank"></a>
    </div>
</div>
