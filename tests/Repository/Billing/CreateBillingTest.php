<?php

namespace App\Tests\Repository;

use App\Repository\BillingRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreateBillingTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testCreateBillingTableIfNotExists()
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Obtient le repository de Billing
        $billingRepository = $container->get(BillingRepository::class);
        
        // Exécute la méthode createTableIfNotExists()
        $billingRepository->createTableIfNotExists();
        
        // Vérifie si la table Billing a été créée
        $schemaManager = $billingRepository->getEntityManager()->getConnection()->getSchemaManager();
        $tableExists = $schemaManager->tablesExist([$billingRepository->getClassMetadata()->getTableName()]);
        
        // Assert
        $this->assertTrue($tableExists);
    }

    // tearDown() reste inchangé
    protected function tearDown(): void
    {
        parent::tearDown();

        // Nettoie la base de données après chaque test
        // Ici, vous devez ajouter du code pour nettoyer la base de données si nécessaire
    }
}
