<?php

namespace davidhirtz\yii2\anakin\composer;

use davidhirtz\yii2\skeleton\web\Application;
use yii\base\BootstrapInterface;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Bootstrap
 * @package davidhirtz\yii2\skeleton\bootstrap
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param array $config
     * @return array
     */
    public static function preInit($config)
    {
        $anakin = [
            'components'=>[
                'assetManager'=>[
                    'bundles'=>[
                        'davidhirtz\yii2\skeleton\assets\CKEditorBootstrapAsset'=>[
                            'editorAssetBundle'=>'davidhirtz\yii2\anakin\assets\AnakinAsset',
                        ],
                        'davidhirtz\yii2\skeleton\assets\AdminAsset'=>[
                            'css'=>[],
                        ],
                    ],
                ],
                'mailer'=>[
                    'htmlLayout'=>'layouts/anakin',
                ],
            ],
            'on beforeAction'=>function(yii\base\ActionEvent $event)
            {
                if($event->action->controller->module instanceof \app\modules\admin\Module)
                {
                    $view=Yii::$app->getView();
                    $alias='@skeleton/modules/admin/views/site';

                    if($view->theme===null)
                    {
                        $view->theme=Yii::createObject([
                            'class'=>'\yii\base\Theme',
                        ]);
                    }

                    if(!isset($view->theme->pathMap[$alias]))
                    {
                        $view->theme->pathMap[$alias]='@app/modules/admin/views/anakin';
                    }

                    \davidhirtz\yii2\anakin\assets\AnakinAsset::register($view);
                }
            }
        ];

        return ArrayHelper::merge($anakin, $config);
    }
}