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
        $this->addPopo();
        $this->addAnnecy();
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
            ['Quel est le nom du village caché de la pluie ?', [
                ['Ame', true],
                ['Konoha', false],
                ['Oto', false],
                ['Kiri', false],
            ]],
            ['Qui n a pas fait parti du groupe Akatsuki ?', [
                ['Orochimaru', false],
                ['Itachi', false],
                ['Danzo', true],
                ['Kisame', false],
            ]],
            ['Quelle est la particularité d Hidan ?', [
                ['Il ne peut pas mourrir', true],
                ['Il est invisible', false],
                ['Il n est pas un ninja', false],
                ['Il est le chef d un village caché ', false],
            ]],
            ['Quel est le nom de l organisation élite de Konoha ?', [
                ['Onbu', false],
                ['Anbu', true],
                ['Ibu', false],
                ['Zanbu', false],
            ]],
            ['Sur quoi repose la base des pouvoirs dans Naruto ?', [
                ['Le karma', false],
                ['Le mantra', false],
                ['Le chakra', true],
                ['La salsa', false],
            ]],
        ];
        $naruto = $this->addQuizz(self::NARUTO);
        foreach ($questions as $question) $this->addQuestion($naruto, $question);
    }


    private function addAnnecy() {
        $questions = [
            ['Quand a été fondé la ville d Annecy ?', [
                ['En 50 av JC', true],
                ['En 845 après JC', false],
                ['En 1166', false],
                ['En 1492', false],
            ]],
            ['Quel est la superficie d Annecy ?', [
                ['76,94 km2', false],
                ['30 km2', false],
                ['11 km2', false],
                ['66,94 km2', true],
            ]],
            ['Quel est le nombre d entreprise à Annecy en 2017 ?', [
                ['450', false],
                ['5000', false],
                ['11078', true],
                ['23487', false],
            ]],
            ['Quel est le périmètre du lac d Annecy ?', [
                ['35 km', true],
                ['28 km', false],
                ['11 km', false],
                ['63 km', false],
            ]],
            ['Quel est le nombre de touristes à Annecy chaque année ?', [
                ['100 000', false],
                ['2,5 millions', true],
                ['500 000', false],
                ['1 million', false],
            ]],
            ['Quel est le nom de la rivière qui traverse la ville ?', [
                ['Le fier', false],
                ['La moselle', false],
                ['L euron', false],
                ['Le thiou', true],
            ]],
            ['Quel est l alcool local de la ville ?', [
                ['La chartreuse', false],
                ['Le génépi', true],
                ['La megademon', false],
                ['La bière mont blanc', false],
            ]],
            ['La basilique d Annecy est appelée basilique de :', [
                ['La rédemption', false],
                ['La création', false],
                ['La visitation', true],
                ['La réincarnation', false],
            ]],
            ['Quel est le surnom d Annecy ?', [
                ['La capitale des Alpes', false],
                ['Le bijou des Alpes', false],
                ['Le trésor des Alpes', false],
                ['La Venise des Alpes', true],
            ]],
            ['Quel est le nom du célèbre bateau restaurant ?', [
                ['La grenouille', false],
                ['La libellule', true],
                ['La mouche', false],
                ['L oiseau', false],
            ]],
        ];
        $annecy = $this->addQuizz(self::ANNECY);
        foreach ($questions as $question) $this->addQuestion($annecy, $question);
    }




    private function addPopo() {
        $questions = [
            ['Quand a été fondé le réseau Polytech ?', [
                ['En 2001', false],
                ['En 2010', false],
                ['EN 2004', true],
                ['En 1998', false],
            ]],
            ['Combien d étudiants sont présents dans le réseau Polytech ?', [
                ['moins de 10 000', false],
                ['entre 13 000 et 17 000', true],
                ['plus de 20 000', false],
                ['entre 17 000 et 20 000', false],
            ]],
            ['Quel évènement est organisé par le réseau Polytech ?', [
                ['Le beach', true],
                ['Les 24h de stan', false],
                ['La cup', false],
                ['La black', false],
            ]],
            ['Combien d écoles font parti du réseau ?', [
                ['11', false],
                ['13', false],
                ['15', true],
                ['17', false],
            ]],
            ['Avant de rejoindre le réseau, quelle école s appelait l ESSTIN ?', [
                ['Polytech Tours', false],
                ['Polytech Angers', false],
                ['Polytech Sorbone', false],
                ['Polytech Nancy', true],
            ]],
            ['Quelle couleur ne fait pas parti du réseau ?', [
                ['Saumon', false],
                ['Rose', false],
                ['Argent', false],
                ['Cyan', true],
            ]],
            ['Quel animal est la mascotte de Polytech Nantes ?', [
                ['Un singe', false],
                ['Un lapin', false],
                ['Un canari', true],
                ['Une lion', false],
            ]],
            ['Quel est le nom de la mascotte précédente (Nantes) ?', [
                ['Cou-cou', false],
                ['Cui-cui', true],
                ['Birdy', false],
                ['Henry', false],
            ]],
            ['Combien de type de PEIP existe il au sein du réseau ?', [
                ['1', false],
                ['6', false],
                ['3', false],
                ['4', true],
            ]],
            ['Quel est la plus vieille école du réseau (date de création) ?', [
                ['Polytech Nancy', true],
                ['Polytech Clermont', false],
                ['Polytech Nice', false],
                ['Polytech Grenoble', false],
            ]],
        ];
        $popo = $this->addQuizz(self::POPO);
        foreach ($questions as $question) $this->addQuestion($popo, $question);
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
