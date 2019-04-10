<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     * @return Response 
     */
    public function generateProduct(ProductRepository $repository, CategoryRepository $catrepo, PaginatorInterface $paginator, Request $request) : Response
    {   
        $products = $repository->findAll();
        $product = $paginator->paginate(
           $products, 
        $request->query->getInt('page', 1),
        12 
    );

        

        $category = $catrepo->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $product,
            'categorys' => $category ,
            
        ]);
    }

    /**
     * @Route("/product/{id}", name="product")
     * @param Product $product
     * @return Response
     */
    public function showProduct(Product $product)
    {   
        return $this->render('/product/index.html.twig', [
            'product' => $product
        ]);
    }

    


}
