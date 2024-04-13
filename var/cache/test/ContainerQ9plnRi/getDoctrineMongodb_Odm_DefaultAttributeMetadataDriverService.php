<?php

namespace ContainerQ9plnRi;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrineMongodb_Odm_DefaultAttributeMetadataDriverService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'doctrine_mongodb.odm.default_attribute_metadata_driver' shared service.
     *
     * @return \Doctrine\ODM\MongoDB\Mapping\Driver\AttributeDriver
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/src/Persistence/Mapping/Driver/MappingDriver.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/persistence/src/Persistence/Mapping/Driver/ColocatedMappingDriver.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/mongodb-odm/lib/Doctrine/ODM/MongoDB/Mapping/Driver/AttributeDriver.php';

        return $container->privates['doctrine_mongodb.odm.default_attribute_metadata_driver'] = new \Doctrine\ODM\MongoDB\Mapping\Driver\AttributeDriver([(\dirname(__DIR__, 4).'/src/Document')]);
    }
}
