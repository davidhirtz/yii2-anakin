<?php
/**
 * Email layout.
 *
 * @var yii\web\View $this
 * @var string $content
 */

use davidhirtz\yii2\anakin\assets\AnakinMailAsset;
use yii\helpers\Html;
use yii\helpers\Url;

$asset = AnakinMailAsset::register($this);
$baseUrl = Url::to($asset->baseUrl, true);
$logo = $asset->getLogoUrl();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->getI18n()->getLanguageCode(); ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="color-scheme" content="only">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<style>
    @font-face {
        font-family: 'ATC Overlook';
        src: url(<?= $baseUrl; ?>/fonts/atcoverlook-regular-webfont.woff2) format('woff2'),
        url(<?= $baseUrl; ?>/fonts/atcoverlook-regular-webfont.woff) format('woff');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'ATC Overlook';
        src: url(<?= $baseUrl; ?>/fonts/atcoverlook-heavy-webfont.woff2) format('woff2'),
        url(<?= $baseUrl; ?>/fonts/atcoverlook-heavy-webfont.woff) format('woff');
        font-weight: bold;
        font-style: normal;
    }

    @font-face {
        font-family: 'Bebas Neue';
        src: url(<?= $baseUrl; ?>/fonts/bebasneue_bold-webfont.woff2) format('woff2'),
        url(<?= $baseUrl; ?>/fonts/bebasneue_bold-webfont.woff) format('woff');
        font-weight: bold;
        font-style: normal;
    }

    :root {
        color-scheme: light only;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        font: 16px/1.4 'ATC Overlook', sans-serif;
        color: #000;
        background-color: #fff;
    }

    .wrap {
        margin: 60px auto 30px;
        padding: 20px;
        max-width: 500px;
    }

    img {
        border: 0;
    }

    a {
        color: #000;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover, a:focus {
        color: #000;
        text-decoration: none;
    }

    h1 {
        margin: 0 0 40px;
        padding: 0 0 10px;
        font: 24px/1.1 'ATC Overlook', sans-serif;
        font-weight: bold;
        color: #000;
        letter-spacing: 0;
        border-bottom: 3px solid #000;
    }

    p {
        margin: 0;
    }

    p:first-child {
        color: #71BCD2;
        font-weight: bold;
    }

    p:not(:last-child) {
        margin-bottom: 1em;
    }

    table, tbody {
        display: block;
    }

    table {
        margin: 30px 0;
        background-color: transparent;
        border-collapse: collapse;
        border-spacing: 0;
    }

    tr {
        display: block;
        margin-bottom: 10px;
        padding: 8px 15px;
        box-shadow: 0 1px 12px 5px rgba(0, 0, 0, 0.04);
    }

    td:first-child {
        display: block;
        padding: 0;
        font-size: 14px;
        color: #71BCD2;
    }


    .btn-wrap {
        margin-top: 40px;
        text-align: center;
    }

    .btn {
        display: inline-block;
        margin-bottom: 0;
        font: 16px/1 'Bebas Neue', sans-serif;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 2px;
        vertical-align: middle;
        touch-action: manipulation;
        cursor: pointer;
        border: 0;
        white-space: nowrap;
        min-width: 120px;
        padding: 12px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }


    .btn-primary {
        color: #fff;
        background-color: #71BCD2;
    }

    .btn-primary:hover {
        color: #fff;
        background-color: #4eaac4;
        text-decoration: none;
    }

    .header {
        box-shadow: 0 1px 12px 5px rgba(0, 0, 0, 0.04);
        padding: 40px;
        text-align: center;
    }

    .logo {
        display: inline-block;
        margin: 0 auto;
        width: <?= $asset->logoWidth; ?>;
    }


    .anakin {
        margin: 65px auto 0;
        width: 70px;
    }
</style>
<?php
if ($logo) {
    ?>
    <div class="header"><img src="<?= Url::to($logo, true); ?>" class="logo" alt="<?= Yii::$app->name; ?>"></div>
    <?php
}
?>
<div class="wrap">
    <h1><?= $this->title; ?></h1>
    <div>
        <?= $content ?>
    </div>
    <?php if ($asset->showAnakinLogo) {
        ?>
        <div class="anakin">
            <img src="<?= $baseUrl . '/images/ANAKIN.svg'; ?>" alt="Anakin">
        </div>
        <?php
    } ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
