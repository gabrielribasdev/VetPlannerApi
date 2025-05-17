<?php

namespace App\Controller;

use App\Entity\CadastroPet;
use App\Dto\CadastroPetDto;
use App\Entity\CadastroTutor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/api', name: 'api_cadastro')]
class CadastroPetController extends AbstractController
{
    #[Route('/cadastro/pet', name: 'app_cadastro_pet', methods: ['POST'])]
    public function cadastrarPet(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['nome'], $data['idade'], $data['tutorId'])) {
            return $this->json(['error' => 'Dados insuficientes para cadastrar o pet.'], 400);
        }

        $em = $doctrine->getManager();
        $pet = new CadastroPet();
        $pet->setNome($data['nome']);
        $pet->setIdade($data['idade']);
        $pet->setSexo($data['sexo'] ?? null);
        $pet->setPeso($data['peso'] ?? null);
        $pet->setRaca($data['raca'] ?? null);
        $pet->setDataCadastro(new \DateTime());
        $tutor = $doctrine->getRepository(CadastroTutor::class)->find($data['tutorId']);
        $pet->setTutor($tutor);

        $em->persist($pet);
        $em->flush();

        return $this->json([
            'message' => 'Pet cadastrado com sucesso!',

        ], 201);
    }

    #[Route('/cadastro/pet/listar', name: 'listar_pets', methods: ['GET'])]
    public function listarPets(ManagerRegistry $doctrine): JsonResponse
    {
        $pets = $doctrine->getRepository(CadastroPet::class)->findAll();

        if (empty($pets)) {
            return $this->json(['message' => 'Nenhum pet encontrado.'], 404);
        }

        $petsData = [];
        foreach ($pets as $pet) {
            $petsData[] = [
                'id' => $pet->getId(),
                'nome' => $pet->getNome(),
                'idade' => $pet->getIdade(),
                'sexo' => $pet->getSexo(),
                'peso' => $pet->getPeso(),
                'raca' => $pet->getRaca(),
                'dataCadastro' => $pet->getDataCadastro()->format('Y-m-d'),
                'tutor' => [
                    'id' => $pet->getTutor()->getId(),
                    'nome' => $pet->getTutor()->getNome(),
                ],
            ];
        }

        return $this->json($petsData);
    }
}
