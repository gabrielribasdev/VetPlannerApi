<?php

namespace App\Controller;

use App\Entity\Servicos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/api', name: 'api_servicos')]
class ServicosController extends AbstractController
{
    #[Route('/servicos/listar', name: 'app_listar_servicos', methods: ['GET'])]
    public function listarServicos(ManagerRegistry $doctrine): JsonResponse
    {
        $servicos = $doctrine->getRepository(Servicos::class)->findAll();

        if (empty($servicos)) {
            return $this->json([]);
        }

        $data = [];
        foreach ($servicos as $servico) {
            $data[] = [
                'id' => $servico->getId(),
                'nome' => $servico->getNome(),
                'duracao' => $servico->getDuracao() ? $servico->getDuracao()->format('H:i') : null,
                'preco' => $servico->getPreco(),
                'observacao' => $servico->getObservacao(),
            ];
        }

        return $this->json($data);
    }
}
