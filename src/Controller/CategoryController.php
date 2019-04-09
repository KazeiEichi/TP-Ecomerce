<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Repository\ProductRepository;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function category(ProductRepository $repository)
    {   
        $product = $repository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $product
        ]);
    }
}
