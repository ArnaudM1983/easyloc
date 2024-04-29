<?php

namespace App\Tests\Repository;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class findOngoingContractsByCustomerUidTest extends KernelTestCase
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

        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }

    public function testfindOngoingContractsByCustomerUid(): void
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

        // Liste des contrats en cours pour le client XYZ456
        $ongoingContracts = $contractRepository->findOngoingContractsByCustomerUid('XYZ456');

        // Assertion
        $this->assertCount(1, $ongoingContracts);
        $this->assertEquals('ABC123', $ongoingContracts[0]->getVehicleUid());
        $this->assertEquals('XYZ456', $ongoingContracts[0]->getCustomerUid());
        
        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }
}
