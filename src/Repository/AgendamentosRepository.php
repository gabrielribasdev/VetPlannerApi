<?php

namespace App\Repository;

use App\Entity\Agendamentos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AgendamentosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Agendamentos::class);
    }

    public function getResumoAgendamentos(): array
    {
        $entityManager = $this->getEntityManager();

        $ano = (int) date('Y');

        $dqlServicos = '
            SELECT s.nome AS servico, s.cor, COUNT(a.id) AS quantidade
            FROM App\Entity\Agendamentos a
            JOIN a.servico s
            GROUP BY s.nome, s.cor
            ORDER BY quantidade DESC
        ';
        $solicitados = $entityManager->createQuery($dqlServicos)->getResult();

        $dqlFinalizados = '
            SELECT COUNT(a.id)
            FROM App\Entity\Agendamentos a
            WHERE a.data < :hoje
        ';
        $finalizados = $entityManager->createQuery($dqlFinalizados)
            ->setParameter('hoje', new \DateTime())
            ->getSingleScalarResult();

        $dqlAbertos = '
            SELECT COUNT(a.id)
            FROM App\Entity\Agendamentos a
            WHERE a.data >= :hoje
        ';
        $emAberto = $entityManager->createQuery($dqlAbertos)
            ->setParameter('hoje', new \DateTime())
            ->getSingleScalarResult();

        $conn = $entityManager->getConnection();
        $sql = '
            SELECT 
                EXTRACT(MONTH FROM a.data) AS mes_num,
                COUNT(a.id) AS quantidade
            FROM agendamentos a
            WHERE EXTRACT(YEAR FROM a.data) = :ano
            GROUP BY mes_num
            ORDER BY mes_num
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('ano', $ano);
        $resultSet = $stmt->executeQuery();
        $resultadoMeses = $resultSet->fetchAllAssociative();

        $mesesNomes = [
            1 => 'janeiro',
            2 => 'fevereiro',
            3 => 'março',
            4 => 'abril',
            5 => 'maio',
            6 => 'junho',
            7 => 'julho',
            8 => 'agosto',
            9 => 'setembro',
            10 => 'outubro',
            11 => 'novembro',
            12 => 'dezembro',
        ];

        $quantidadesPorMes = [];
        foreach ($resultadoMeses as $item) {
            $quantidadesPorMes[(int) $item['mes_num']] = (int) $item['quantidade'];
        }

        $mes = [];
        for ($i = 1; $i <= 12; $i++) {
            $mes[] = [
                'mes' => $mesesNomes[$i],
                'quantidade' => $quantidadesPorMes[$i] ?? 0,
            ];
        }

        return [
            'solicitados' => $solicitados,
            'status' => [
                'finalizados' => (int) $finalizados,
                'emAberto' => (int) $emAberto,
            ],
            'mes' => $mes,
        ];
    }
}
