<?php

namespace App\Tests\Repository;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ListContractsByCustomerTest extends KernelTestCase
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

    public function testListContractsByCustomerUid(): void
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de contrat
        $contractRepository = $container->get(ContractRepository::class);

        // Création de quelques contrats avec différentes valeurs
        $contract1 = new Contract();
        $contract1->setVehicleUid('ABC123');
        $contract1->setCustomerUid('XYZ456');
        $contract1->setSignDatetime(new \DateTime('2024-03-30 10:00:00'));
        $contract1->setLocBeginDatetime(new \DateTime('2024-03-31 08:00:00'));
        $contract1->setLocEndDatetime(new \DateTime('2024-04-02 08:00:00'));
        $contract1->setReturningDatetime(new \DateTime('2024-04-02 09:00:00'));
        $contract1->setPrice('500.00');

        $contract2 = new Contract();
        $contract2->setVehicleUid('DEF456');
        $contract2->setCustomerUid('XYZ456');
        $contract2->setSignDatetime(new \DateTime('2024-04-01 11:00:00'));
        $contract2->setLocBeginDatetime(new \DateTime('2024-04-02 09:00:00'));
        $contract2->setLocEndDatetime(new \DateTime('2024-04-04 09:00:00'));
        $contract2->setReturningDatetime(new \DateTime('2024-04-04 10:00:00'));
        $contract2->setPrice('700.00');

        $contract3 = new Contract();
        $contract3->setVehicleUid('GHI789');
        $contract3->setCustomerUid('ABC123');
        $contract3->setSignDatetime(new \DateTime('2024-04-02 12:00:00'));
        $contract3->setLocBeginDatetime(new \DateTime('2024-04-03 10:00:00'));
        $contract3->setLocEndDatetime(new \DateTime('2024-04-05 10:00:00'));
        $contract3->setReturningDatetime(new \DateTime('2024-04-05 11:00:00'));
        $contract3->setPrice('600.00');

        // Persiste les contrats dans la base de données
        $entityManager = $container->get('doctrine')->getManager();
        $entityManager->persist($contract1);
        $entityManager->persist($contract2);
        $entityManager->persist($contract3);
        $entityManager->flush();

        // Liste des contrats pour le client XYZ456
        $contracts = $contractRepository->findContractsByCustomerUid('XYZ456');

        // Assertions
        $this->assertCount(2, $contracts);
        $this->assertEquals('ABC123', $contracts[0]->getVehicleUid());
        $this->assertEquals('XYZ456', $contracts[0]->getCustomerUid());
        $this->assertEquals('DEF456', $contracts[1]->getVehicleUid());
        $this->assertEquals('XYZ456', $contracts[1]->getCustomerUid());

        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }
}
