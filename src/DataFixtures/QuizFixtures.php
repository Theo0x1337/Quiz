<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Entity\Reponse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuizFixtures extends Fixture
{
    const POPO = ['Polytech', 'Un quiz sur les écoles du réseau Polytech ! ', 'Testez vos connaissances sur le réseau d\'écoles d\'ingénieurs Polytech, à travers des questions en tout genre !', true, 'popo.png', 'popoIco.png'];
    const ANNECY = ['Annecy', 'Un quiz sur la ville d\'Annecy !', 'Annecy fait partie des plus belles villes de France, et des endroits où il fait bon vivre. Repondez à ces questions et voyez à quel point vous connaissez cette ville !', true, 'annecy.jpg', 'annecy.jpg'];
    const NARUTO = ['Naruto', 'Un quiz sur l\'univers de naruto !', 'Pillier des mangas et animes, Naruto est une référence dans le domaine. Au programme, des questions sur les personnages et l\'histoire du manga !', true, 'naruto.jpeg', 'narutoIco.jpg'];

    private $manager;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->addQuizz(self::POPO);
        $this->addQuizz(self::ANNECY);
        $this->addNaruto();
        $manager->flush();
    }

    private function addNaruto() {
        $questions = [
            ['Quel est le grand rival de Naruto ?', [
                ['Sasuke', true],
                ['Gaara', false],
                ['Neji', false],
                ['Rock Lee', false],
            ]],
            ['Quel est le numéro d équipe de Naruto ?', [
                ['11', false],
                ['7', true],
                ['28', false],
                ['3', false],
            ]],
            ['Qui est l instructeur de Naruto, Sasuke et Sakura ?', [
                ['Asuma', false],
                ['Le 3eme hokage', false],
                ['Kakashi', true],
                ['Minato', false],
            ]],
            ['Quels sont les noms des parents de Naruto ?', [
                ['Minato et Sakura', false],
                ['Kushina et Asuma', false],
                ['Minato et Kushina', true],
                ['Manito et Kushina', false],
            ]],
            ['Pourquoi Itachi a fuit Konoha ?', [
                ['Il n aime pas la ville', false],
                ['Il avait une mission', false],
                ['Il à été chassé', false],
                ['Il à tué ses parents', true],
            ]],
        ];
        $naruto = $this->addQuizz(self::NARUTO);
        foreach ($questions as $question) $this->addQuestion($naruto, $question);
    }

    private function addQuizz(array $quiz) : Quizz
    {
        [$nom, $sousTitre, $desc, $featured, $image, $thumbnail] = $quiz;
        $quiz = new Quizz();
        $quiz->setNom($nom);
        $quiz->setSousTitre($sousTitre);
        $quiz->setDescription($desc);
        $quiz->setIsFeatured($featured);
        $quiz->setImage($image);
        $quiz->setThumbnail($thumbnail);
        $this->manager->persist($quiz);

        return $quiz;
    }

    private function addQuestion(Quizz $quizz, array $questionArray)
    {
        [$text, $reponses] = $questionArray;
        $question = new Question();
        $question->setText($text);
        $quizz->addQuestion($question);
        $this->manager->persist($question);
        foreach ($reponses as $reponse) $this->addReponse($question, $reponse);
    }

    private function addReponse(Question $question, array $reponseArray)
    {
        [$text, $estVrai] = $reponseArray;
        $reponse = new Reponse();
        $reponse->setText($text);
        $reponse->setIsTrue($estVrai);
        $question->addReponse($reponse);
        $this->manager->persist($reponse);
    }
}
