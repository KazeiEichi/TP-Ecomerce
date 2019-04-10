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
        \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);
        $j = []; 

        for ($i = 1; $i <= 5; $i++)
        {
            $category = new Category();
            $category->setName($faker->deviceManufacturer);
            $manager->persist($category);
            $j [$i] = $category;
        }
        
            $manager->flush();

        for ($i = 0; $i < 120; $i++) {
            $product = new Product();
            $product->setName($faker->deviceModelName);
            $product->setPrice(mt_rand(200, 2000));
            $product->setDescription('Possimus quaerat et nam mollitia laboriosam nulla optio aut ipsa quia molestiae architecto laborum nihil aut ex.');
            $product->setImage('https://dummyimage.com/600x400/55595c/fff');
            $product->setCategory($j[rand(1, 5)]);
            $product->setDate($faker->dateTime);
            $product->setScore(mt_rand(0, 5));
            $manager->persist($product);
        }

            $manager->flush();  

       
    }


}
