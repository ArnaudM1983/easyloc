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

    public function testListContractsByCustomerUid(): void
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de contrat
        $contractRepository = $container->get(ContractRepository::class);

        // UID du client pour lequel nous voulons lister les contrats
        $customerUid = 'XYZ456';

        // Appel de la méthode pour lister les contrats associés à l'UID du client
        $contracts = $contractRepository->findContractsByCustomerUid($customerUid);

        // Assertions
        $this->assertNotEmpty($contracts);
        foreach ($contracts as $contract) {
            $this->assertInstanceOf(Contract::class, $contract);
            // Vérifie que le contrat appartient bien au client avec l'UID spécifié
            $this->assertEquals($customerUid, $contract->getCustomerUid());
        }

        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }
}
