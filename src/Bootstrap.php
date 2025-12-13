<?php

declare(strict_types=1);

namespace Hirtz\Anakin;

use Hirtz\Anakin\assets\AnakinAsset;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Hirtz\Skeleton\Assets\TinyMceSkinAssetBundle;
use Hirtz\Skeleton\Modules\Admin\Module;
use Hirtz\Skeleton\Web\Application;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\i18n\PhpMessageSource;
use yii\web\View;

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
//        Yii::setAlias('@anakin', __DIR__);
//        Yii::setAlias('@skeleton/mail/layouts/html', '@anakin/views/layouts/mail');
//
//        Yii::$app->params['email'] ??= 'hello@anakin.co';
//
//        Yii::$app->extendComponents([
//            'assetManager' => [
//                'bundles' => [
//                    TinyMceSkinAssetBundle::class => [
//                        'sourcePath' => '@anakin/assets/tinymce/skins/',
//                    ],
//                    AdminAssetBundle::class => [
//                        'css' => [], // Remove admin CSS, the Anakin theme will register its own CSS
//                        'faviconOptions' => [
//                            'href' => '/images/favicons/favicon-32x32.png',
//                            'sizes' => '32x32',
//                            'type' => 'image/png',
//                        ],
//                    ],
//                ],
//            ],
//            'i18n' => [
//                'translations' => [
//                    'anakin' => [
//                        'class' => PhpMessageSource::class,
//                        'basePath' => '@anakin/../messages',
//                    ],
//                ],
//            ],
//            'view' => [
//                'theme' => [
//                    'pathMap' => [
//                        '@skeleton/modules/admin/views/dashboard' => '@anakin/views/dashboard',
//                    ],
//                ],
//            ]
//        ]);
//
//        // Todo
//        //        Event::on(TinyMceEditor::class, TinyMceEditor::EVENT_INIT, function ($event) {
//        //            $asset = AnakinAsset::register(Yii::$app->getView());
//        //            $event->sender->clientOptions['content_css'] ??= "$asset->baseUrl/css/tinymce.min.css";
//        //        });
//
//        Event::on(View::class, View::EVENT_BEGIN_PAGE, function (): void {
//            // @phpstan-ignore-next-line the controller might not be available during an exception in request handling
//            if (Yii::$app->controller?->module instanceof Module || Yii::$app->controller?->module->module instanceof Module) {
//                AnakinAsset::register(Yii::$app->getView());
//            }
//        });
    }
}
