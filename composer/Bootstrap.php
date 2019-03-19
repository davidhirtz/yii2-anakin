<?php

namespace davidhirtz\yii2\anakin\composer;

use davidhirtz\yii2\skeleton\web\Application;
use yii\base\BootstrapInterface;
use Yii;

/**
 * Class Bootstrap
 * @package davidhirtz\yii2\skeleton\bootstrap
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        Yii::setAlias('@anakin', dirname(__DIR__));

        $assetManager = $app->getAssetManager();
        $assetManager->bundles['davidhirtz\yii2\skeleton\assets\CKEditorBootstrapAsset']['editorAssetBundle'] = 'davidhirtz\yii2\anakin\assets\AnakinAsset';
        $assetManager->bundles['davidhirtz\yii2\skeleton\assets\AdminAsset']['css'] = [];

        $app->getMailer()->htmlLayout = '@anakin/views/layouts/mail';

        $app->getI18n()->translations['anakin'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->sourceLanguage,
            'basePath' => '@anakin/messages',
        ];

        $app->on(Application::EVENT_BEFORE_ACTION, function (yii\base\ActionEvent $event) {
            if ($event->action->controller->module instanceof \davidhirtz\yii2\skeleton\modules\admin\Module) {
                $view = Yii::$app->getView();
                $alias = '@skeleton/modules/admin/views/dashboard';

                if ($view->theme === null) {
                    $view->theme = Yii::createObject([
                        'class' => '\yii\base\Theme',
                    ]);
                }

                if (!isset($view->theme->pathMap[$alias])) {
                    $view->theme->pathMap[$alias] = '@anakin/views/dashboard';
                }

                \davidhirtz\yii2\anakin\assets\AnakinAsset::register($view);
            }
        });
    }
}