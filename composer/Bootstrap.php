<?php

namespace davidhirtz\yii2\anakin\composer;

use davidhirtz\yii2\anakin\assets\AnakinAsset;
use davidhirtz\yii2\skeleton\modules\admin\Module;
use davidhirtz\yii2\skeleton\web\Application;
use yii\base\BootstrapInterface;
use Yii;

/**
 * Overrides the backend theme with the Anakin theme and sets default email contact.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        Yii::setAlias('@anakin', dirname(__DIR__));
        Yii::$app->params['email'] ??= 'hello@anakin.co';

        // Registers Anakin assets on Admin module.
        $app->on(Application::EVENT_BEFORE_ACTION, function (yii\base\ActionEvent $event) {
            if ($event->action->controller->module instanceof Module || $event->action->controller->module->module instanceof Module) {
                Yii::$app->extendComponents([
                    'assetManager' => [
                        'bundles' => [
                            'davidhirtz\yii2\skeleton\assets\CKEditorBootstrapAsset' => [
                                'sourcePath' => '@anakin/assets/ckeditor-bootstrap',
                            ],
                            'davidhirtz\yii2\skeleton\assets\AdminAsset' => [
                                'css' => [],
                            ],
                        ],
                    ],
                    'i18n' => [
                        'translations' => [
                            'anakin' => [
                                'class' => 'yii\i18n\PhpMessageSource',
                                'basePath' => '@anakin/messages',
                            ],
                        ],
                    ],
                    'mailer' => [
                        'htmlLayout' => '@anakin/views/layouts/mail',
                    ],
                ]);

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

                AnakinAsset::register($view);
            }
        });
    }
}