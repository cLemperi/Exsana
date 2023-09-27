<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/exsana/produits', name: 'app_product_list', methods: ['GET'])]
    public function index(ProductRepository $productRepository,PaginatorInterface $paginator,Request $request): \Symfony\Component\HttpFoundation\Response
    {
        $listProducts = $productRepository->findAll();

        $products = $paginator->paginate(
            $listProducts,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('exsana/produit/{id}{slug}', name: 'app_product_show', methods: ['GET'])]
    public function listProduct(ProductRepository $productRepository, $id): Response
    {
        $products = $productRepository->find($id);
        if (!$products) {
            // Si aucune formation n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('Le produit n\'existe pas');
        }

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }
}
    

