<?php

namespace App\Tests\Repository;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use App\Repository\BillingRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class findLateContractsTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    // Nettoyer les données de la base de données après chaque test
    protected function tearDown(): void
    {
        parent::tearDown();

        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de contrat
        $contractRepository = $container->get(ContractRepository::class);

        // Suppression de toutes les entrées de la table Contract
        $contracts = $contractRepository->findAll();
        foreach ($contracts as $contract) {
            $contractRepository->removeContract($contract);
        }

        // Récupération du repository de billing
        $billingRepository = $container->get(BillingRepository::class);

        // Suppression de toutes les entrées de la table Billing
        $billings = $billingRepository->findAll();
        foreach ($billings as $billing) {
            $billingRepository->removeBilling($billing);
        }

        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }

    public function testfindLateContracts(): void
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de contrat
        $contractRepository = $container->get(ContractRepository::class);

        // Création d'un contrat avec toutes les valeurs nécessaires
        $contract = new Contract();
        $contract->setVehicleUid('ABC123');
        $contract->setCustomerUid('XYZ456');
        $contract->setSignDatetime(new \DateTime('2024-03-30 10:00:00'));
        $contract->setLocBeginDatetime(new \DateTime('2024-03-31 08:00:00'));
        $contract->setLocEndDatetime(new \DateTime('2024-12-02 08:00:00'));
        $contract->setReturningDatetime(new \DateTime('2024-12-02 09:00:00'));
        $contract->setPrice('500.00');

        // Persiste le contrat dans la base de données
        $entityManager = $container->get('doctrine')->getManager();
        $entityManager->persist($contract);
        $entityManager->flush();

        // Liste des contrats en retard
        $lateContracts = $contractRepository->findLateContracts();

        // Assertion
        $this->assertCount(1, $lateContracts);
        $this->assertEquals('ABC123', $lateContracts[0]->getVehicleUid());
        $this->assertEquals('XYZ456', $lateContracts[0]->getCustomerUid());
        
        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }
}
