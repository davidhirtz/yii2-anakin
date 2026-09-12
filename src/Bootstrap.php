<?php

declare(strict_types=1);

namespace Hirtz\Anakin;

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Hirtz\Skeleton\Models\User;
use Hirtz\Skeleton\Modules\Admin\Module;
use Hirtz\Skeleton\Web\Application;
use Yii;
use yii\base\ActionEvent;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\i18n\PhpMessageSource;

class Bootstrap implements BootstrapInterface
{
    /**
     * @param Application<User> $app
     */
    public function bootstrap($app): void
    {
        Yii::setAlias('@anakin', __DIR__);
        Yii::setAlias('@skeleton/../resources/mail/layouts/html', '@anakin/../resources/mail/layouts/html');

        $app->getI18n()->translations['anakin'] ??= [
            'class' => PhpMessageSource::class,
            'basePath' => '@anakin/messages',
        ];

        $app->params['email'] ??= 'hello@anakin.co';

        $app->extendComponents([
            'assetManager' => [
                'bundles' => [
                    AdminAssetBundle::class => [
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
            ],
        ]);

        Event::on(Module::class, Module::EVENT_BEFORE_ACTION, function (ActionEvent $event): void {
            /** @var Module $module */
            $module = $event->sender;
            $view = $event->action->controller->getView();

            $view->on($view::EVENT_BEGIN_PAGE, function () use ($module, $view) {
                AnakinAssetBundle::register($view);
            });
        });
    }
}
