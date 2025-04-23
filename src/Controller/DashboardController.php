<?php
 
 namespace App\Controller;

 use App\Dto\ServicosDto;
 use App\Entity\Servicos;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\JsonResponse;
 use Symfony\Component\Routing\Annotation\Route;
 use Doctrine\Persistence\ManagerRegistry;
 
 #[Route('/api', name: 'api_servicos')]
 class DashboardController extends AbstractController
 {
     #[Route('/servicos', name: 'app_servicos')]
     public function list(ManagerRegistry $doctrine): JsonResponse
     {
         $servicos = $doctrine->getRepository(Servicos::class)->findAll();
     
         $data = [];
         foreach ($servicos as $servico) {
             $servicoDTO = new ServicosDto($servico);
             $data[] = $servicoDTO;
         }
     
         $dataArray = array_map(fn($dto) => $dto->__serialize(), $data);
     
         return $this->json($dataArray);
     }
     
 }
 