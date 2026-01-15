<?php

declare(strict_types=1);

namespace Hirtz\Anakin;

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Hirtz\Skeleton\Assets\TinyMceAssetBundle;
use Hirtz\Skeleton\Modules\Admin\Module;
use Hirtz\Skeleton\Web\Application;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\i18n\PhpMessageSource;
use yii\web\View;

class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application $app
     */
    public function bootstrap($app): void
    {
        Yii::setAlias('@anakin', __DIR__);
        Yii::setAlias('@skeleton/mail/layouts/html', '@anakin/views/layouts/mail');

        $app->getI18n()->translations['anakin'] ??= [
            'class' => PhpMessageSource::class,
            'basePath' => '@anakin/messages',
        ];

        Yii::$app->params['email'] ??= 'hello@anakin.co';

        Yii::$app->extendComponents([
            'assetManager' => [
                'bundles' => [
                    TinyMceAssetBundle::class => [
//                        'sourcePath' => '@anakin/../resources/assets/tinymce/skins/',
                    ],
                    AdminAssetBundle::class => [
//                        'css' => [], // Remove admin CSS, the Anakin theme will register its own CSS
                        'faviconOptions' => [
                            'href' => '/images/favicons/favicon-32x32.png',
                            'sizes' => '32x32',
                            'type' => 'image/png',
                        ],
                    ],
                ],
            ],
            'view' => [
                'theme' => [
                    'pathMap' => [
                        '@skeleton/../resources/views/admin/views/dashboard' => '@anakin/../resources/views/dashboard',
                    ],
                ],
            ]
        ]);

        // Todo
        //        Event::on(TinyMceEditor::class, TinyMceEditor::EVENT_INIT, function ($event) {
        //            $asset = AnakinAsset::register(Yii::$app->getView());
        //            $event->sender->clientOptions['content_css'] ??= "$asset->baseUrl/css/tinymce.min.css";
        //        });

        Event::on(View::class, View::EVENT_BEGIN_PAGE, function (): void {
//            if (Yii::$app->controller?->module instanceof Module || Yii::$app->controller?->module->module instanceof Module) {
//                AnakinAssetBundle::register(Yii::$app->getView());
//            }
        });
    }
}
