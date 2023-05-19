<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoriesController.php',
        ]);
    }
    #[Route('/categories/{id}', name: 'categories_show')]
    public function show(EntityManagerInterface $entityManager,Request $request): Response
    {
        $categories = $entityManager->getRepository(Categories::class)->find($id);

        return new Response($categories->getName());
    }
}
