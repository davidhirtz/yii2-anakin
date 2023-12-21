<?php

use davidhirtz\yii2\anakin\Bootstrap;
use yii\web\Session;

return [
    'id' => 'yii2-anakin',
    'aliases' => [
        // This is a fix for the broken aliasing of `BaseMigrateController::getNamespacePath()`
        '@davidhirtz/yii2/anakin' => __DIR__ . '/../../src/',
    ],
    'bootstrap' => [
        Bootstrap::class,
    ],
    'components' => [
        'assetManager' => [
            'basePath' => '@runtime/assets',
            'linkAssets' => true,
        ],
        'db' => [
            'dsn' => getenv('MYSQL_DSN') ?: 'mysql:host=127.0.0.1;dbname=yii2_anakin_test',
            'username' => getenv('MYSQL_USER') ?: 'root',
            'password' => getenv('MYSQL_PASSWORD') ?: '',
            'charset' => 'utf8',
            ...is_file(__DIR__ . '/db.php') ? require (__DIR__ . '/db.php') : [],
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'session' => [
            'class' => Session::class,
        ],
    ],
    'params' => [
        'cookieValidationKey' => 'test',
    ],
];
