<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductsController.php',
        ]);
    }
    #[Route('/products', name: 'create_products')]
    public function createProducts(EntityManagerInterface $entityManager,Request $request): Response
    {
        $res = $request->getContent();
        $products = new Products();
        $products->setName($res->name);
        $products->setSlug($res->slug);
        $products->setStock($res->stock);
        $products->setCategory($res->category);

        $entityManager->persist($products);
        $entityManager->flush();

        return new Response($product->getId());
    }
    #[Route('/products/edit/{id}', name: 'products_edit')]
    public function update(EntityManagerInterface $entityManager, Request $request): Response
    {
        $res = $request->getContent();
        $products = $entityManager->getRepository(Products::class)->find($res->id);

        $products->setName($res->name);
        $products->setSlug($res->slug);
        $products->setStock($res->stock);
        $products->setCategory($res->category);
        $entityManager->flush();

        return $this->redirectToRoute('products_show', [
            'id' => $products->getId()
        ]);
    }
}
