<?php
// app/ApplicationAspectKernel.php

require_once 'TestMonitorAspect.php';

use Aspect\TestMonitorAspect;
use Go\Core\AspectKernel;
use Go\Core\AspectContainer;

/**
 * Application Aspect Kernel
 */
class ApplicationAspectKernel extends AspectKernel
{

    /**
     * Returns the path to the application autoloader file, typical autoload.php
     *
     * @return string
     */
    protected function getApplicationLoaderPath()
    {
        return realpath(dirname(__FILE__).'/../../../../vendor/yiisoft/yii/framework/yii.php');
    }

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new TestMonitorAspect());
    }
}
