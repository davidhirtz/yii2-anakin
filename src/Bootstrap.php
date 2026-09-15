<?php

declare(strict_types=1);

namespace Hirtz\Anakin;

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinAsideMenu;
use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinNavBar;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Hirtz\Skeleton\Models\User;
use Hirtz\Skeleton\Modules\Admin\Module;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideMenu;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar;
use Hirtz\Skeleton\Web\Application;
use Yii;
use yii\base\ActionEvent;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\base\Module as BaseModule;
use yii\i18n\PhpMessageSource;
use yii\web\View;

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
                            'href' => '/images/favicons/favicon.svg',
                            'sizes' => 'any',
                            'type' => 'image/svg+xml',
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

        $definitions = [
            NavBar::class => AnakinNavBar::class,
            AsideMenu::class => AnakinAsideMenu::class,
        ];

        foreach ($definitions as $name => $class) {
            if (!Yii::$container->has($name)) {
                Yii::$container->set($name, $class);
            }
        }

        Event::on(Module::class, BaseModule::EVENT_BEFORE_ACTION, function (ActionEvent $event): void {
            /** @var View $view */
            $view = $event->action->controller->getView();

            $view->on($view::EVENT_BEGIN_PAGE, function () use ($view): void {
                AnakinAssetBundle::register($view);
            });
        });
    }
}
