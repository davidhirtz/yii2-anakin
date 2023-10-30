<?php

namespace davidhirtz\yii2\anakin\composer;

use davidhirtz\yii2\anakin\assets\AnakinAsset;
use davidhirtz\yii2\skeleton\assets\AdminAsset;
use davidhirtz\yii2\skeleton\assets\TinyMceSkinAssetBundle;
use davidhirtz\yii2\skeleton\modules\admin\Module;
use davidhirtz\yii2\skeleton\web\Application;
use davidhirtz\yii2\skeleton\widgets\forms\TinyMceEditor;
use yii\base\BootstrapInterface;
use Yii;
use yii\base\Theme;
use yii\i18n\PhpMessageSource;

/**
 * Overrides the backend theme with the Anakin theme and sets default email contact.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application $app
     */
    public function bootstrap($app): void
    {
        Yii::setAlias('@anakin', dirname(__DIR__));
        Yii::$app->params['email'] ??= 'hello@anakin.co';

        // Registers Anakin assets on Admin module.
        $app->on(Application::EVENT_BEFORE_ACTION, function (yii\base\ActionEvent $event) {
            if ($event->action->controller->module instanceof Module || $event->action->controller->module->module instanceof Module) {
                $view = Yii::$app->getView();
                $asset = AnakinAsset::register($view);

                Yii::$app->extendComponents([
                    'assetManager' => [
                        'bundles' => [
                            TinyMceSkinAssetBundle::class => [
                                'sourcePath' => '@anakin/assets/tinymce/skins/',
                            ],
                            // Remove default CSS as the Anakin theme will restyle the admin area.
                            AdminAsset::class => [
                                'css' => [],
                            ],
                        ],
                    ],
                    'i18n' => [
                        'translations' => [
                            'anakin' => [
                                'class' => PhpMessageSource::class,
                                'basePath' => '@anakin/messages',
                            ],
                        ],
                    ],
                    'mailer' => [
                        'htmlLayout' => '@anakin/views/layouts/mail',
                    ],
                ]);

                Yii::$container->set(TinyMceEditor::class, [
                    'contentCss' => "$asset->baseUrl/css/tinymce.min.css",
                ]);

                // Set default favicon, this can be overridden in the config.
                if ($bundle = (Yii::$app->getAssetManager()->bundles[AdminAsset::class] ?? false)) {
                    $bundle['faviconOptions']['href'] ??= '/images/favicons/favicon-32x32.png';
                    $bundle['faviconOptions']['sizes'] ??= '32x32';
                    $bundle['faviconOptions']['type'] ??= 'image/png';
                }

                $view->theme ??= Yii::createObject([
                    'class' => Theme::class,
                ]);

                $view->theme->pathMap['@skeleton/modules/admin/views/dashboard'] ??= '@anakin/views/dashboard';
            }
        });
    }
}