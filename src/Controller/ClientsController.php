<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ClientsController extends AbstractController
{
    #[Route('/clients', name: 'app_clients')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ClientsController.php',
        ]);
    }
    #[Route('/clients/{id}', name: 'clients_show')]
    public function show(EntityManagerInterface $entityManager,Request $request): Response
    {
        $clients = $entityManager->getRepository(Clients::class)->find($id);

        if (!$clients) {
            throw $this->createNotFoundException(
                'Il y a pas un client pour ce ID : '.$id
            );
        }

        return new Response($clients->getName());
    }
}
