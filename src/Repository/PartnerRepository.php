<?php

namespace App\Repository;

use App\Entity\Partner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partner::class);
    }

    public function save(Partner $partner): void
    {
        $this->_em->persist($partner);
        $this->_em->flush();
    }

    public function findOneByAffiseId(string $affiseId): ?Partner
    {
        return $this->findOneBy(['affiseId' => $affiseId]);
    }
}
