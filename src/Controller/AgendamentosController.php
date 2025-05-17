<?php

namespace App\Controller;

use App\Entity\Agendamentos;
use App\Entity\Servicos;
use App\Entity\CadastroPet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api', name: 'api_agendamentos')]
class AgendamentosController extends AbstractController
{
    #[Route('/agendamentos/salvar', name: 'salvar_agendamento', methods: ['POST'])]
    public function salvarAgendamento(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['pet'], $data['servico_id'], $data['data'], $data['horario'], $data['preco'])) {
            return $this->json(['error' => 'Dados insuficientes para realizar o agendamento.'], 400);
        }

        $em = $doctrine->getManager();

        $pet = $doctrine->getRepository(CadastroPet::class)->find($data['pet']);
        if (!$pet) {
            return $this->json(['error' => 'Pet não encontrado.'], 404);
        }

        $servico = $doctrine->getRepository(Servicos::class)->find($data['servico_id']);
        if (!$servico) {
            return $this->json(['error' => 'Serviço não encontrado.'], 404);
        }

        $agendamento = new Agendamentos();
        $agendamento->setPet($pet);
        $agendamento->setServico($servico);
        $agendamento->setData(new \DateTime($data['data']));
        $agendamento->setHorario(new \DateTime($data['horario']));
        $agendamento->setPreco($data['preco']);

        $em->persist($agendamento);
        $em->flush();

        return $this->json(['message' => 'Agendamento realizado com sucesso!'], 201);
    }

    #[Route('/agendamentos/listar', name: 'listar_agendamentos', methods: ['GET'])]
    public function listarAgendamentos(ManagerRegistry $doctrine): JsonResponse
    {
        $agendamentos = $doctrine->getRepository(Agendamentos::class)->findAll();

        $data = [];

        foreach ($agendamentos as $agendamento) {
            $data[] = [
                'id' => $agendamento->getId(),
                'pet' => $agendamento->getPet()->getNome(), 
                'servico' => $agendamento->getServico()->getNome(),
                'data' => $agendamento->getData()->format('Y-m-d'),
                'horario' => $agendamento->getHorario()->format('H:i'),
                'preco' => $agendamento->getPreco(),
            ];
        }

        return $this->json($data);
    }

    #[Route('/agendamentos/dashboard', name: 'listar_dados_dashboard', methods: ['GET'])]
    public function listarDadosDashboard(ManagerRegistry $doctrine): JsonResponse
    {
        $agendamentos = $doctrine->getRepository(Agendamentos::class)->getResumoAgendamentos();

        return $this->json($agendamentos);
    }
        
}
