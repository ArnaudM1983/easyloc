<?php

namespace ContainerVySBhDr;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrineMongodb_Odm_Command_DropSchemaService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'doctrine_mongodb.odm.command.drop_schema' shared service.
     *
     * @return \Doctrine\Bundle\MongoDBBundle\Command\DropSchemaDoctrineODMCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Tools/Console/Command/Schema/AbstractCommand.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Tools/Console/Command/CommandCompatibility.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Tools/Console/Command/Schema/DropCommand.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm-bundle/src/Command/DropSchemaDoctrineODMCommand.php';

        $container->privates['doctrine_mongodb.odm.command.drop_schema'] = $instance = new \Doctrine\Bundle\MongoDBBundle\Command\DropSchemaDoctrineODMCommand();

        $instance->setName('doctrine:mongodb:schema:drop');

        return $instance;
    }
}
