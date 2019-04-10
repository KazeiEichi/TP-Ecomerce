<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\Product;
use App\Entity\Category;


class AppFixtures extends Fixture 
{
    public function load(ObjectManager $manager)
    {   
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setDescription('<p>lorem</p>');
            $product->setImage('https://dummyimage.com/600x400/55595c/fff');

            $manager->persist($product);
        }

            $manager->flush();

        for ($i = 0; $i < 5; $i++)
        {
            $category = new Category();
            $category->setName('Catégorie ' . $faker->title );
            $manager->persist($category);
        }
        
            $manager->flush();
    }


}
