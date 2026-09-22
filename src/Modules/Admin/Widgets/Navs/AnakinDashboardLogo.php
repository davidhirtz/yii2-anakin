<?php

declare(strict_types=1);

namespace Hirtz\Anakin\Modules\Admin\Widgets\Navs;

use Hirtz\Anakin\Assets\AnakinAssetBundle;
use Hirtz\Skeleton\Html\Img;
use Hirtz\Skeleton\Widgets\Widget;
use Override;
use Stringable;
use Yii;

class AnakinDashboardLogo extends Widget
{
    #[Override]
    protected function renderContent(): string|Stringable
    {
        /** @var AnakinAssetBundle $bundle */
        $bundle = Yii::$app->getAssetManager()->getBundle(AnakinAssetBundle::class);
        $logoUrl = $bundle->getLogoUrl();

        return $logoUrl
            ? Img::make()
                ->attributes($bundle->logoAttributes)
                ->addClass('hidden-sticky')
                ->src($logoUrl)
            : '';
    }
}
