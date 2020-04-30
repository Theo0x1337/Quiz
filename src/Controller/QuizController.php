<?php
/**
 * Created by PhpStorm.
 * User: bernardintheo
 * Date: 29/04/2020
 * Time: 11:41
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Quizz;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizController extends AbstractController
{
    public function quiz()
    {
        return $this->render('quiz.html.twig', [
            'quizzes' => $this->getDoctrine()->getRepository(Quizz::class)->findAll()
        ]);
    }

    public function play($id)
    {
        $questions = $this->getDoctrine()->getRepository(Quizz::class)->find($id)->getQuestions();
        return $this->render('play.html.twig', [
            'questions' => $questions
        ]);
    }
}
