<?php

namespace ContainerJpvl5NE;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrineMongodb_Odm_StopwatchCommandLoggerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'doctrine_mongodb.odm.stopwatch_command_logger' shared service.
     *
     * @return \Doctrine\Bundle\MongoDBBundle\APM\StopwatchCommandLogger
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm-bundle/src/APM/StopwatchCommandLogger.php';

        return $container->privates['doctrine_mongodb.odm.stopwatch_command_logger'] = new \Doctrine\Bundle\MongoDBBundle\APM\StopwatchCommandLogger(($container->services['debug.stopwatch'] ??= new \Symfony\Component\Stopwatch\Stopwatch(true)));
    }
}
