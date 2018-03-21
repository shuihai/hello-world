<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=101.201.31.185;dbname=robot_scene_activity',
            'username' => 'zhihuioa',
            'password' => 'zhihuioa',
//            'dsn' => 'mysql:host=localhost;dbname=robot_cloud',
//            'username' => 'root',
//            'password' => 'root',
            'charset' => 'utf8',
        ],
        'db_oldnav' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=101.201.31.185;dbname=robot_scene_activity_nav',
            'username' => 'zhihuioa',
            'password' => 'zhihuioa',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];