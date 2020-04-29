<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Quizz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    public function accueil()
    {
        $quizzes = $this->getDoctrine()->getRepository(Quizz::class)->findBy(['isFeatured' => true]);
        return $this->render('index.html.twig', ['quizzes' => $quizzes]);
    }
}
