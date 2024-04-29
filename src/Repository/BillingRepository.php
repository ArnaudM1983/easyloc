<?php

namespace App\Repository;

use App\Entity\Billing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BillingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Billing::class);
    }

    //  Pouvoir créer la table Billing si elle n’existe pas.
    public function createTableIfNotExists(): void
    {
        // Vérifie si la table Billing existe dans la base de données
        $metadata = $this->getClassMetadata();
        $schemaTool = $this->getEntityManager()->getSchemaManager()->createSchema();
        if (!$metadata->isMappedSuperclass && !$schemaTool->tablesExist([$metadata->getTableName()])) {
            // Si la table n'existe pas, créez-la
            $schemaTool->createSchema([$metadata]);
        }
    }

    //  Pouvoir accéder à un payement en particulier à partir de sa clé unique
    public function findBillingById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }
    
    // Créer un payement
    public function createBilling(Billing $billing): Billing
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($billing);
        $entityManager->flush();

        return $billing;
    }   

    // Modifier un payement 
    public function updateBilling(Billing $billing): Billing
    {   
        $entityManager = $this->getEntityManager();
        $entityManager->flush();

        return $billing;
    }

    // Supprimer un payement
    public function deleteBilling(Billing $billing): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($billing);
        $entityManager->flush();
    }

}
