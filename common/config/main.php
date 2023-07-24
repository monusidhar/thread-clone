<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'fixture' => [
            'class' => 'yii\test\Fixture',
            'namespace' => 'common\fixtures',
            'dataFile' => '@common/fixtures/data/user.php', 
        ],
        'security' => [
            'class' => 'yii\base\Security',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
    ],
];
