<?php

namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Repository\ContractRepository;

class ContractFindTest extends KernelTestCase
{
    private ?ContractRepository $contractRepository;

    protected function setUp(): void
    {
        // Appel de la méthode parente setUp pour initialiser le noyau de l'application
        parent::setUp();

        // Récupération du conteneur de services Symfony
        self::bootKernel();
    }



    public function testFindContractById(): void
    {
        // Création d'un contrat factice
        $contract = new Contract();
        $contract->setVehicleUid('123456');
        $contract->setCustomerUid('789012');
        $contract->setSignDatetime(new \DateTime());
        $contract->setLocBeginDatetime(new \DateTime());
        $contract->setLocEndDatetime(new \DateTime());
        $contract->setReturningDatetime(new \DateTime());
        $contract->setPrice('1000.00');

        // Persistez le contrat dans la base de données
        $this->entityManager->persist($contract);
        $this->entityManager->flush();

        // Récupération de l'ID du contrat
        $contractId = $contract->getId();

        // Recherche du contrat par son ID
        $foundContract = $this->contractRepository->findContractById($contractId);

        // Vérification si le contrat trouvé correspond au contrat original
        $this->assertInstanceOf(Contract::class, $foundContract);
        $this->assertEquals('123456', $foundContract->getVehicleUid());
        $this->assertEquals('789012', $foundContract->getCustomerUid());
        // Assurez-vous de vérifier les autres propriétés du contrat si nécessaire
    }
}
