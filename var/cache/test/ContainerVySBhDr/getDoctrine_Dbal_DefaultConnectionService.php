<?php

namespace ContainerVySBhDr;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrine_Dbal_DefaultConnectionService extends App_KernelTestDebugContainer
{
    /**
     * Gets the public 'doctrine.dbal.default_connection' shared service.
     *
     * @return \Doctrine\DBAL\Connection
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/dbal/src/Connection.php';

        $container->services['doctrine.dbal.default_connection'] = $instance = ($container->privates['doctrine.dbal.connection_factory'] ?? $container->load('getDoctrine_Dbal_ConnectionFactoryService'))->createConnection(['url' => $container->getEnv('resolve:DATABASE_URL'), 'driver' => 'pdo_mysql', 'charset' => 'utf8mb4', 'use_savepoints' => true, 'dbname_suffix' => '_test'.$container->getEnv('string:default::TEST_TOKEN'), 'host' => 'localhost', 'port' => NULL, 'user' => 'root', 'password' => NULL, 'driverOptions' => [], 'serverVersion' => '11.3.2-MariaDB', 'defaultTableOptions' => []], ($container->privates['doctrine.dbal.default_connection.configuration'] ?? $container->load('getDoctrine_Dbal_DefaultConnection_ConfigurationService')), ($container->privates['doctrine.dbal.default_connection.event_manager'] ?? $container->load('getDoctrine_Dbal_DefaultConnection_EventManagerService')), []);

        $instance->setNestTransactionsWithSavepoints(true);

        return $instance;
    }
}
