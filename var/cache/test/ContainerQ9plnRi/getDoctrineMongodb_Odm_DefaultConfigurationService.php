<?php

namespace ContainerQ9plnRi;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrineMongodb_Odm_DefaultConfigurationService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'doctrine_mongodb.odm.default_configuration' shared service.
     *
     * @return \Doctrine\ODM\MongoDB\Configuration
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Configuration.php';

        $container->privates['doctrine_mongodb.odm.default_configuration'] = $instance = new \Doctrine\ODM\MongoDB\Configuration();

        $instance->setDocumentNamespaces(['App' => 'App\\Document']);
        $instance->setMetadataCache(($container->privates['doctrine_mongodb.odm.default_metadata_cache'] ??= new \Symfony\Component\Cache\Adapter\ArrayAdapter()));
        $instance->setMetadataDriverImpl(($container->privates['doctrine_mongodb.odm.default_metadata_driver'] ?? $container->load('getDoctrineMongodb_Odm_DefaultMetadataDriverService')));
        $instance->setProxyDir(($container->targetDir.''.'/doctrine/odm/mongodb/Proxies'));
        $instance->setProxyNamespace('MongoDBODMProxies');
        $instance->setAutoGenerateProxyClasses(2);
        $instance->setHydratorDir(($container->targetDir.''.'/doctrine/odm/mongodb/Hydrators'));
        $instance->setHydratorNamespace('Hydrators');
        $instance->setAutoGenerateHydratorClasses(1);
        $instance->setDefaultDB($container->getEnv('resolve:MONGODB_DB'));
        $instance->setDefaultCommitOptions([]);
        $instance->setDefaultDocumentRepositoryClassName('Doctrine\\ODM\\MongoDB\\Repository\\DocumentRepository');
        $instance->setDefaultGridFSRepositoryClassName('Doctrine\\ODM\\MongoDB\\Repository\\DefaultGridFSRepository');
        $instance->setPersistentCollectionDir(($container->targetDir.''.'/doctrine/odm/mongodb/PersistentCollections'));
        $instance->setPersistentCollectionNamespace('PersistentCollections');
        $instance->setAutoGeneratePersistentCollectionClasses(0);
        $instance->setRepositoryFactory(($container->privates['doctrine_mongodb.odm.container_repository_factory'] ?? $container->load('getDoctrineMongodb_Odm_ContainerRepositoryFactoryService')));

        return $instance;
    }
}