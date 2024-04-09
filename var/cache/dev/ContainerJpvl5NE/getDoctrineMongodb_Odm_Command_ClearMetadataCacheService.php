<?php

namespace ContainerJpvl5NE;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrineMongodb_Odm_Command_ClearMetadataCacheService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'doctrine_mongodb.odm.command.clear_metadata_cache' shared service.
     *
     * @return \Doctrine\Bundle\MongoDBBundle\Command\ClearMetadataCacheDoctrineODMCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Tools/Console/Command/CommandCompatibility.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Tools/Console/Command/ClearCache/MetadataCommand.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm-bundle/src/Command/ClearMetadataCacheDoctrineODMCommand.php';

        $container->privates['doctrine_mongodb.odm.command.clear_metadata_cache'] = $instance = new \Doctrine\Bundle\MongoDBBundle\Command\ClearMetadataCacheDoctrineODMCommand();

        $instance->setName('doctrine:mongodb:cache:clear-metadata');

        return $instance;
    }
}
