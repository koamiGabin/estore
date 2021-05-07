<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create('fr_FR');
        $users=[];
        for ($i=0; $i <50 ; $i++)
        { 
            $user= new User();
            $user->setUsername($faker->name);
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastname());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setCreatedAt(new \DateTime());
            $manager->persist($user);
            $users[]=$user;
        }
        $categories=[];
        for ($i=0; $i < 15; $i++) 
        { 
            $category= new Category();
            $category->setTitle($faker->Words(2,true));
            $category->setDescription('Lorem ipsum'.$i);
            $category->setImage($faker->imageurl());
            $manager->persist($category);
            $categories[]=$category;
        }

             
        for ($i=0; $i < 100; $i++) 
        { 
           $article= new Article();
           $article->setTitle($faker->Words(1,true));
           $article->setContent('Lorem ipsum'.$i);
           $article->setImage($faker->imageurl());
           $article->setCreatedAt(new \DateTime());
           $article->addCategory($categories[$faker->numberBetween(0,14)]);
           $article->setAuthor($users[$faker->numberBetween(0,49)]);
           $manager->persist($article);           
        }

        $manager->flush();
    }
}
