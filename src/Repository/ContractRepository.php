<?php

namespace App\Repository;

use App\Entity\Contract;
use DateTime;
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
        // Persiste l'objet dans la base de données
        $this->getEntityManager()->persist($contract);
        $this->getEntityManager()->flush();

        return $contract;
    }

    //  Pouvoir accéder à un contrat en particulier à partir de sa clé unique
    public function findContractById($id)
    {
        return $this->findOneBy(['id' => $id]);
    }

    // Pouvoir créer un nouveau contrat à une autre date
    public function createContractWithDate($data, \DateTimeInterface $date)
    {
        $contract = new Contract();
        // Initialise les propriétés du contrat avec les données fournies
        $contract->setVehicleUid($data['vehicle_uid']);
        $contract->setCustomerUid($data['customer_uid']);
        $contract->setSignDatetime(new \DateTime()); // Utilise la date actuelle pour sign_datetime
        $contract->setLocBeginDatetime($date); // Utilise la nouvelle date pour loc_begin_datetime
        // Définit une valeur pour loc_end_datetime
        $locEndDateTime = clone $date;
        $locEndDateTime->modify('+1 hour');
        $contract->setLocEndDatetime($locEndDateTime);
        // Initialise returning_datetime avec la même valeur que loc_end_datetime
        $contract->setReturningDatetime($locEndDateTime);
        // Initialise price avec une valeur par défaut 
        $contract->setPrice($data['price'] ?? '0.00'); 
        // Persiste l'objet dans la base de données
        $this->getEntityManager()->persist($contract);
        $this->getEntityManager()->flush();
    
        return $contract;
    }
    
    // Pouvoir supprimer un contrat
    public function removeContract(Contract $contract)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($contract);
        $entityManager->flush();
    }

    // Liste tous les contrats associés à un UID de Customer
    public function findContractsByCustomerUid(string $customerUid): array
    {
        return $this->createQueryBuilder('c')
            ->innerJoin(Customer::class, 'cust', 'WITH', 'cust.id = c.customer')
            ->where('cust.uid = :customerUid')
            ->setParameter('customerUid', $customerUid)
            ->getQuery()
            ->getResult();
    }
}
