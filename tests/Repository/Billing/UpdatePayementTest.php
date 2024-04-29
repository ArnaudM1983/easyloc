<?php

namespace App\Tests\Repository;

use App\Entity\Billing;
use App\Entity\Contract;
use App\Repository\BillingRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UpdatePayementTest extends KernelTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testUpdateBilling(): void
    {
        // Obtient le conteneur de services à partir du kernel du test
        $container = static::getContainer();
        
        // Récupération du repository de paiement
        $billingRepository = $container->get(BillingRepository::class);

        // Création d'un nouvel objet Billing
        $billing = new Billing();
        
        // Définition des propriétés de l'objet Billing
        $contract = new Contract(); // Créer une nouvelle instance de Contract
        $contract->setVehicleUid('ABC123');
        $contract->setCustomerUid('XYZ456');
        $contract->setSignDatetime(new \DateTime('2024-03-30 10:00:00'));
        $contract->setLocBeginDatetime(new \DateTime('2024-03-31 08:00:00'));
        $contract->setLocEndDatetime(new \DateTime('2024-04-02 08:00:00'));
        $contract->setReturningDatetime(new \DateTime('2024-04-02 09:00:00'));
        $contract->setPrice('500.00');
        $billing->setContract($contract);
        $billing->setAmount('100.00');
        
        // Appel de la méthode pour créer le paiement
        $createdBilling = $billingRepository->createBilling($billing);

        // Modification de la quantité
        $updatedAmount = '150.00';
        $createdBilling->setAmount($updatedAmount);

        // Appel de la méthode pour mettre à jour le paiement
        $updatedBilling = $billingRepository->updateBilling($createdBilling);

        // Récupération de l'objet mis à jour depuis la base de données
        $updatedBillingFromDB = $billingRepository->find($updatedBilling->getId());

        // Vérification que la quantité a été mise à jour correctement
        $this->assertEquals($updatedAmount, $updatedBillingFromDB->getAmount());

        // Réinitialise les gestionnaires d'exceptions après le test
        restore_exception_handler();
    }

}
