<?php

namespace App\Tests\Repository;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ContractFindTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testFindContractById(): void
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de contrat
        $contractRepository = $container->get(ContractRepository::class);
        
        // Création d'un contrat pour le tester
        $contract = new Contract();
        $contract->setVehicleUid('ABC123');
        $contract->setCustomerUid('XYZ456');
        $contract->setSignDatetime(new \DateTime('2024-03-30 10:00:00'));
        $contract->setLocBeginDatetime(new \DateTime('2024-03-31 08:00:00'));
        $contract->setLocEndDatetime(new \DateTime('2024-04-02 08:00:00'));
        $contract->setReturningDatetime(new \DateTime('2024-04-02 09:00:00'));
        $contract->setPrice('500.00');

        // Persiste le contrat dans la base de données
        $entityManager = $container->get('doctrine')->getManager();
        $entityManager->persist($contract);
        $entityManager->flush();

        // Récupère l'ID du contrat pour le tester
        $contractId = $contract->getId();

        // Appel de la méthode à tester
        $foundContract = $contractRepository->findContractById($contractId);

        // Vérifie que le contrat récupéré correspond au contrat créé
        $this->assertEquals($contractId, $foundContract->getId());

        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }
}
