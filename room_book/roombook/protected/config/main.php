<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'RoomBook',

    // preloading 'log' component
    'preload' => array(
        'log',
        'bootstrap'
    ),
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/yiibooster'),
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),
    'modules' => array(
        //'admin',
        // uncomment the following to enable the Gii tool
        'auth' => array(
            'strictMode' => TRUE,
            // when enabled authorization items cannot be assigned children of the same type.
            'userClass' => 'User',
            // the name of the user model class.
            'userIdColumn' => 'id',
            // the name of the user id column.
            'userNameColumn' => 'email',
            // the name of the user name column.
            'defaultLayout' => 'application.views.layouts.mainauth',
            // the layout used by the module.
            //'viewDir' => realpath(__DIR__ . '/../modules/auth/views/'), // the path to view files to use with this module.
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'a',
            'ipFilters' => array('127.0.0.1', '::1'),
            // 'newFileMode'=>0666,
            // 'newDirMode'=>0777,
        ),
    ),

    'defaultController' => 'site/index',

    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),

        'user' => array(
            'allowAutoLogin' => true,
            'class' => 'auth.components.AuthWebUser',
            'admins' => array('admin'), // users with full access
            'loginUrl' => array('/site/login'),
        ),
        'session' => array(
            'class' => 'CCacheHttpSession',
        ),
        'authManager' => array(
            //'class'=>'CDbAuthManager',
            'class' => 'auth.components.CachedDbAuthManager',
            'cachingDuration' => 7200,
            'connectionID' => 'db',
            'behaviors' => array(
                'auth' => array(
                    'class' => 'auth.components.AuthBehavior',
                ),
            ),
        ),

        'securityManager' => array(
            'cryptAlgorithm' => 'rijndael-128',
            'encryptionKey' => '123456789012345678901234',
        ),
        'dbcache' => array(
            'class' => 'system.caching.CDbCache',
        ),

        'input' => array(
            'class' => 'CmsInput',
            'cleanPost' => TRUE,
            'cleanGet' => TRUE,
        ),

        'cache' => array(
            'class' => 'CDummyCache'
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=room_booker',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8'
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'urlManager' => array(
            'cacheID' => 'cache',
            'urlFormat' => 'path',
            'showScriptName' => FALSE,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),

        'log' => array(

            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'logFile' => 'custom.log',
                    'categories' => 'custom.*',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'trace',
                    'categories' => 'vardump',
                ),
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);