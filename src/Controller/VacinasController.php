<?php

namespace App\Controller;

use App\Entity\CadastroPet;
use App\Dto\CadastroPetDto;
use App\Entity\CadastroTutor;
use App\Entity\Vacinas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/api', name: 'api_cadastro_')]
class VacinasController extends AbstractController
{
    #[Route('/vacinas/salvar', name: 'vacinas', methods: ['POST'])]
    public function cadastrarPet(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $em = $doctrine->getManager();
        $pet = new Vacinas();
        $pet->setNome($data['nome']);
        $pet->setMarca($data['marca']);
        $pet->setPeriodo($data['periodo'] ?? null);
        $pet->setPreco($data['preco'] ?? null);

        $em->persist($pet);
        $em->flush();

        return $this->json([
            'message' => 'Vacina cadastrada com sucesso!',

        ], 201);
    }

    #[Route('/vacinas/listar', name: 'listar_vacinas', methods: ['GET'])]
    public function listarPets(ManagerRegistry $doctrine): JsonResponse
    {
        $vacinas = $doctrine->getRepository(Vacinas::class)->findAll();

        $vacinasData = [];
        foreach ($vacinas as $vacina) {
            $vacinasData[] = [
                'id' => $vacina->getId(),
                'nome' => $vacina->getNome(),
                'marca' => $vacina->getMarca(),
                'periodo' => $vacina->getPeriodo(),
                'preco' => $vacina->getPreco(),
            ];
        }

        return $this->json($vacinasData);
    }
}
