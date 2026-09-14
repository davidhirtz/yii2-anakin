<?php

declare(strict_types=1);

namespace Hirtz\Anakin;

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Hirtz\Skeleton\Helpers\EventHelper;
use Hirtz\Skeleton\Html\Svg;
use Hirtz\Skeleton\Models\User;
use Hirtz\Skeleton\Modules\Admin\Module;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideLogo;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBarLogo;
use Hirtz\Skeleton\Web\Application;
use Hirtz\Skeleton\Widgets\Widget;
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

        Event::on(Module::class, BaseModule::EVENT_BEFORE_ACTION, function (ActionEvent $event): void {
            /** @var View $view */
            $view = $event->action->controller->getView();

            $view->on($view::EVENT_BEGIN_PAGE, function () use ($view): void {
                AnakinAssetBundle::register($view);

                EventHelper::on(NavBarLogo::class, Widget::EVENT_CONFIGURE, function (NavBarLogo $logo): void {
                    $logo->content(Svg::make()
                        ->addStyle(['height' => '1rem', 'aspect-ratio' => '888 / 137'])
                        ->viewBox('0 0 888 137')
                        ->content('<path id="anakin" d="M57.49.426L0 136.212h21.75l9.697-21.425h52.227l8.728 21.425h22.72L57.49.426zm0 52.782l16.625 41.005h-34.08l17.456-41.005zM261.413.85v77.19L208.63.85h-20.916v134.936h20.918V37.174l52.783 77.47v21.283h20.917V.85M410.06.426l-57.492 135.786h21.75l9.697-21.425h52.227l8.728 21.425h22.72L410.06.426zm-.14 52.782l16.763 41.005h-34.08l17.318-41.005zM609.548.85l-28.815 50.94-8.728 16.883-13.022 24.12V.852h-20.92v134.936h20.92L583.365 90.1l25.352 45.688h23.55l-36.71-66.97L633.096.85m69.684 134.936h20.088V.993H702.78M866.666.85v77.19L813.884.85h-20.918v134.936h20.918V37.174l52.782 77.47v21.283h20.918V.85"/>'));
                });

                EventHelper::on(AsideLogo::class, Widget::EVENT_CONFIGURE, function (AsideLogo $logo): void {
                    $logo
                        ->addStyle(['height' => '2.5rem', 'place-content' => 'center'])
                        ->content(Svg::make()
                            ->addStyle(['height' => '1rem', 'aspect-ratio' => '888 / 137'])
                            ->viewBox('0 0 888 137')
                            ->content('<use href="#anakin"/>'));
                });
            });
        });
    }
}
