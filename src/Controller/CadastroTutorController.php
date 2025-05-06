<?php

namespace App\Controller;

use App\Entity\CadastroTutor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/api/cadastro', name: 'api_cadastro')]
class CadastroTutorController extends AbstractController
{
    #[Route('/tutor', name: 'app_cadastro_tutor', methods: ['POST'])]
    public function cadastrarTutor(Request $request, ManagerRegistry $doctrine): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (empty($data['nome'])) {
            return $this->json(['error' => 'O campo nome é obrigatório para cadastrar o tutor.'], 400);
        }

        $em = $doctrine->getManager();

        $tutor = new CadastroTutor();
        $tutor->setNome($data['nome']);
        $tutor->setEmail($data['email'] ?? null);
        $tutor->setTelefone($data['telefone'] ?? null);
        $tutor->setCpf($data['cpf'] ?? null);
        $tutor->setEndereco($data['endereco'] ?? null);

        $em->persist($tutor);
        $em->flush();

        return $this->json([
            'message' => 'Tutor cadastrado com sucesso!',
            'tutorId' => $tutor->getId(),
        ], 201);
    }

    #[Route('/tutor/listar', name: 'app_listar_tutores', methods: ['GET'])]
    public function listarTutores(ManagerRegistry $doctrine): JsonResponse
    {
        $tutores = $doctrine->getRepository(CadastroTutor::class)->findAll();

        if (empty($tutores)) {
            return $this->json([]);
        }

        $data = [];
        foreach ($tutores as $tutor) {
            $data[] = [
                'id' => $tutor->getId(),
                'nome' => $tutor->getNome(),
                'email' => $tutor->getEmail(),
                'telefone' => $tutor->getTelefone(),
                'cpf' => $tutor->getCpf(),
                'endereco' => $tutor->getEndereco(),
            ];
        }

        return $this->json($data);
    }

}
