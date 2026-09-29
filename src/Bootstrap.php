<?php

declare(strict_types=1);

namespace Hirtz\Anakin;

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinAsideMenu;
use Hirtz\Anakin\Modules\Admin\Widgets\Navs\AnakinNavBar;
use Hirtz\Skeleton\Base\ConfigBootstrapInterface;
use Hirtz\Skeleton\Assets\AdminAssetBundle;
use Hirtz\Skeleton\Models\User;
use Hirtz\Skeleton\Modules\Admin\Module;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\AsideMenu;
use Hirtz\Skeleton\Modules\Admin\Widgets\Navs\NavBar;
use Hirtz\Skeleton\Web\Application;
use Override;
use Yii;
use yii\base\ActionEvent;
use yii\base\Event;
use yii\base\Module as BaseModule;
use yii\i18n\PhpMessageSource;
use yii\web\View;

class Bootstrap implements ConfigBootstrapInterface
{
    #[Override]
    public static function getDefaultConfig(): array
    {
        return [
            'components' => [
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
                'i18n' => [
                    'translations' => [
                        'anakin' => [
                            'class' => PhpMessageSource::class,
                            'basePath' => '@anakin/../messages',
                            'forceTranslation' => true,
                        ],
                    ],
                ],
                'view' => [
                    'theme' => [
                        'pathMap' => [
                            '@skeleton/../resources/views/admin/dashboard' => '@anakin/../resources/views/dashboard',
                        ],
                    ],
                ],
            ],
            'container' => [
                'definitions' => [
                    AsideMenu::class => AnakinAsideMenu::class,
                    NavBar::class => AnakinNavBar::class,
                ],
            ],
            'params' => [
                'email' => 'hello@anakin.co',
            ],
        ];
    }

    /**
     * Anakin's projects want sharper AVIF transformations than the media default of 60.
     */
    final public const int MEDIA_AVIF_QUALITY = 80;

    /**
     * @param Application<User> $app
     */
    public function bootstrap($app): void
    {
        Yii::setAlias('@anakin', __DIR__);
        Yii::setAlias('@skeleton/../resources/mail/layouts/html', '@anakin/../resources/mail/layouts/html');

        // named by package, the theme requiring nothing of yii2-media; a project's own `avifQuality` wins
        if (isset($app->extensions['davidhirtz/yii2-media'])) {
            $app->extendModule('media', ['avifQuality' => self::MEDIA_AVIF_QUALITY]);
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
