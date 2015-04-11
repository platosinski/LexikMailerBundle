<?php

namespace Lexik\Bundle\MailerBundle\Tests\Unit;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;
use Lexik\Bundle\MailerBundle\Tests\Fixtures\TestData;

/**
 * Base unit test class providing functions to create a mock entity manger, load schema and fixtures.
 *
 * @author Cédric Girard <c.girard@lexik.fr>
 */
abstract class BaseUnitTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Create the database schema.
     *
     * @param \Doctrine\ORM\EntityManager $em
     *
     * @internal param \Doctrine\ORM\EntityManager $om
     */
    protected function createSchema(EntityManager $em)
    {
        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($em);
        $schemaTool->createSchema($em->getMetadataFactory()->getAllMetadata());
    }

    /**
     * Load test fixtures.
     *
     * @param \Doctrine\ORM\EntityManager $em
     *
     * @internal param \Doctrine\ORM\EntityManager $om
     */
    protected function loadFixtures(EntityManager $em)
    {
        $purger = new ORMPurger();
        $executor = new ORMExecutor($em, $purger);

        $executor->execute(array(new TestData()), false);
    }

    /**
     * EntityManager mock object together with annotation mapping driver and
     * pdo_sqlite database in memory
     *
     * @return EntityManager
     */
    protected function getMockSqliteEntityManager()
    {
        $cache = new \Doctrine\Common\Cache\ArrayCache();

        $config = Setup::createConfiguration(false, null, null);

        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
        $config->setProxyDir(sys_get_temp_dir());
        $config->setProxyNamespace('Proxy');
        $config->setAutoGenerateProxyClasses(true);
        $config->setClassMetadataFactoryName('Doctrine\ORM\Mapping\ClassMetadataFactory');
        $config->setDefaultRepositoryClassName('Doctrine\ORM\EntityRepository');

        $driverChain  = new MappingDriverChain();

        $driverChain->addDriver(new SimplifiedYamlDriver(array(
            __DIR__.'/../../Resources/config/doctrine' => 'Lexik\Bundle\MailerBundle\Entity',
        )), 'Lexik\Bundle\MailerBundle\Entity');

        $driverChain->addDriver($config->newDefaultAnnotationDriver(array(
            __DIR__.'/../Entity',
        ), false), 'Lexik\Bundle\MailerBundle\Tests\Entity');

        $config->setMetadataDriverImpl($driverChain);

        $conn = array(
            'driver' => 'pdo_sqlite',
            'memory' => true,
        );

        $em = \Doctrine\ORM\EntityManager::create($conn, $config);

        return $em;
    }
}
