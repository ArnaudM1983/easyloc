<?php

namespace App\Tests\Repository;

use App\Entity\Contract;
use App\Repository\ContractRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RemoveContractTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testRemoveContract()
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de contrat
        $contractRepository = $container->get(ContractRepository::class);

        // Création d'un contrat avec toutes les valeurs nécessaires
        $contract = new Contract();
        $contract->setVehicleUid('ABC123'); // Valeur valide pour la colonne 'vehicle_uid'
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

        // Récupère l'ID du contrat pour le supprimer
        $contractId = $contract->getId();

        // Suppression du contrat
        $contractRepository->removeContract($contract);

        // Vérifie que le contrat a bien été supprimé de la base de données
        $this->assertNull($contractRepository->findContractById($contractId));
    }
}
