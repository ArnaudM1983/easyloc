<?php

namespace App\Tests\Repository;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CreateContractWithDateTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testCreateContractWithDate()
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de contrat
        $contractRepository = $container->get(ContractRepository::class);
        
        // Créer une nouvelle instance de DateTime pour une date spécifiée
        $date = new \DateTime('2024-04-12');

        // Données factices pour le contrat
        $contractData = [
            'vehicle_uid' => 'vehicle_uid_123',
            'customer_uid' => 'customer_uid_456',
        ];

        // Appelle la méthode createContractWithDate pour créer un nouveau contrat avec la date spécifiée
        $contract = $contractRepository->createContractWithDate($contractData, $date);

        // Vérifie que le contrat a été correctement créé
        $this->assertInstanceOf(Contract::class, $contract);
        $this->assertEquals('vehicle_uid_123', $contract->getVehicleUid());
        $this->assertEquals('customer_uid_456', $contract->getCustomerUid());
        $this->assertInstanceOf(\DateTimeInterface::class, $contract->getSignDatetime());
        $this->assertEquals($date, $contract->getLocBeginDatetime());
        // Ajoutez d'autres assertions au besoin

        // Nettoye les gestionnaires d'exceptions
        restore_exception_handler();
    }
}
