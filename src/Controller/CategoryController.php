<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Entity\Category;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category")
     * @param  $id
     * @return Response 
     */
    public function generateProduct(ProductRepository $repository, CategoryRepository $catrepo, PaginatorInterface $paginator, Request $request,  $id = false) : Response
    {   
        $category = $catrepo->findAll();

        if ($id)
        {
            $products = $repository->findByCategory_id($id);
            $categoryname =  array_values(array_filter($category, function($category)use ($id){
                return $category->getId() == $id;
            }));
            
            $categoryname = $categoryname[0]->getName();
            
        }

        else
        {
            $products = $repository->findAll();
            $categoryname = 'Catégories';
        }

        
        $product = $paginator->paginate(
           $products, 
        $request->query->getInt('page', 1),
        12 
    );
       
        $lastproduct = $repository->findLastProduct();
        
        

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'products' => $product,
            'categorys' => $category ,
            'lastproduct' => $lastproduct,
            'currentcat' => $categoryname
        ]);
    }
    /**
     * @Route("/product/{id}", name="product")
     * 
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
