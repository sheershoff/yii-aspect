<?php

// automatically debug on local machines and not debug on production
if($_SERVER['APPLICATION_ENV']==''||$_SERVER['APPLICATION_ENV']=='production'){
    defined('YII_DEBUG') or define('YII_DEBUG',false);    
}else{
    defined('YII_DEBUG') or define('YII_DEBUG',true);
}
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// Do not use application autoloader for the following files
include __DIR__ . '/../vendor/lisachenko/go-aop-php/src/Go/Core/AspectKernel.php';
include __DIR__ . '/protected/extensions/go-aop-php/ApplicationAspectKernel.php';

// Initialize an application aspect container
$applicationAspectKernel = ApplicationAspectKernel::getInstance();
$applicationAspectKernel->init(array(
        // Configuration for autoload namespaces
        'autoload' => array(
            'Go'               => realpath(__DIR__ . '/../vendor/lisachenko/go-aop-php/src/'),
            'TokenReflection'  => realpath(__DIR__ . '/../vendor/andrewsville/php-token-reflection/'),
            'Doctrine\\Common' => realpath(__DIR__ . '/../vendor/doctrine/common/lib/')
        ),
        // Application root directory
        'appDir' => __DIR__ . '/../',
        // Cache directory should be disabled for now
        'cacheDir' => null,
        // Include paths restricts the directories where aspects should be applied, or empty for all source files
        'includePaths' => array(
        )
));

// change the following paths if necessary
$yii=dirname(__FILE__).'/../vendor/yiisoft/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

//require_once($yii); // commented out because AOP-php is running
Yii::createWebApplication($config)->run();
