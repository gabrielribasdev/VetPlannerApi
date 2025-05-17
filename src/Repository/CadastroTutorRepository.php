<?php

namespace App\Repository;

use App\Entity\CadastroTutor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CadastroTutor>
 */
class CadastroTutorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CadastroTutor::class);
    }

    
}
