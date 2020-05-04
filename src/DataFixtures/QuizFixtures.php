<?php

namespace App\DataFixtures;

use App\Entity\Quizz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuizFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $quizzes = [
            ['Polytech', 'Un quiz sur les écoles du réseau Polytech ! ', 'Testez vos connaissances sur le réseau d\'écoles d\'ingénieurs Polytech, à travers des questions en tout genre !', true, 'popo.png', 'popoIco.png'],
            ['Annecy', 'Un quiz sur la ville d\'Annecy !', 'Annecy fait partie des plus belles villes de France, et des endroits où il fait bon vivre. Repondez à ces questions et voyez à quel point vous connaissez cette ville !', true, 'annecy.jpg', 'annecy.jpg'],
            ['Naruto', 'Un quiz sur l\'univers de naruto !', 'Pillier des mangas et animes, Naruto est une référence dans le domaine. Au programme, des questions sur les personnages et l\'histoire du manga !', true, 'naruto.jpeg', 'narutoIco.jpg'],
        ];

        foreach ($quizzes as [$nom, $soustitre, $desc, $featured, $image, $thumbnail]) {
            $quiz = new Quizz();
            $quiz->setNom($nom);
            $quiz->setSousTitre($soustitre);
            $quiz->setDescription($desc);
            $quiz->setIsFeatured($featured);
            $quiz->setImage($image);
            $quiz->setThumbnail($thumbnail);
            $manager->persist($quiz);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
