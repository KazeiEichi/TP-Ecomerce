<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * 
     */
    public function index(ProductRepository $repository)
    {   
        $products = $repository->findLast4Products();
        $bestproducts = $repository->findBestScore();
        $favproducts = $repository->findFavorite();
                                
        if (!empty($favproducts)){
           $favproducts = $favproducts [array_rand($favproducts)];
            
        }
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'products' => $products,
            'bestproducts' => $bestproducts,
            'favproducts' => $favproducts,

        ]);
    }
}
