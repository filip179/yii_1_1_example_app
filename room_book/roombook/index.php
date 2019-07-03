<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/../yii/framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

ini_set('xdebug.var_display_max_depth', 20);
ini_set('xdebug.var_display_max_children', 2560);
ini_set('xdebug.var_display_max_data', 10240);

defined('YII_DEBUG') or define('YII_DEBUG', TRUE);

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
