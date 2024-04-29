<?php

namespace App\Tests\Repository;

use App\Entity\Billing;
use App\Entity\Contract;
use App\Repository\BillingRepository;
use App\Repository\ContractRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BillingFindTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testFindBillingById(): void
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de facturation
        $billingRepository = $container->get(BillingRepository::class);
        
        // Création d'un objet Billing pour le tester
        $billing = new Billing();
        // Vous devez également définir le contrat associé à ce billing pour éviter les erreurs de référence nulle
        $contract = new Contract();
        $contract->setVehicleUid('ABC123');
        $contract->setCustomerUid('XYZ456');
        $contract->setSignDatetime(new \DateTime('2024-03-30 10:00:00'));
        $contract->setLocBeginDatetime(new \DateTime('2024-03-31 08:00:00'));
        $contract->setLocEndDatetime(new \DateTime('2024-04-02 08:00:00'));
        $contract->setReturningDatetime(new \DateTime('2024-04-02 09:00:00'));
        $contract->setPrice('500.00');
        $billing->setContract($contract);
        $billing->setAmount('100.00');

        // Persiste la facturation dans la base de données
        $entityManager = $container->get('doctrine')->getManager();
        $entityManager->persist($billing);
        $entityManager->flush();

        // Récupère l'ID de la facturation pour le tester
        $billingId = $billing->getId();

        // Appel de la méthode à tester
        $foundBilling = $billingRepository->findBillingById($billingId);

        // Vérifie que la facturation récupérée correspond à la facturation créée
        $this->assertEquals($billingId, $foundBilling->getId());

        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }
}
