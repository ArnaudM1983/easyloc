<?php

namespace App\Repository;

use App\Entity\Contract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contract::class);
    }

    //  Pouvoir créer la table Contract si elle n’existe pas
    public function createContract($data)
    {
        $contract = new Contract();
        // Initialise les propriétés du contrat avec les données fournies
        // Puis, persiste l'objet dans la base de données
        $this->getEntityManager()->persist($contract);
        $this->getEntityManager()->flush();

        return $contract;
    }

    //  Pouvoir accéder à un contrat en particulier à partir de sa clé unique
    public function findContractById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    // Pouvoir supprimer un contrat
    public function removeContract(Contract $contract)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($contract);
        $entityManager->flush();
    }
}
