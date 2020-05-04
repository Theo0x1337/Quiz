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

    public function ajouterQuestion($id)
    {
        return $this->render('ajouterQuestion.html.twig', [
            'id' => $id
        ]);
    }

    public function validerQuestion()
    {
        $question = $_POST['question'];
        $bonneRep = $_POST['bonneRep'];
        $mauvaiseRep1 = $_POST['mauvaiseRep1'];

        if(isset($_POST['mauvaiseRep2'])){
            $mauvaiseRep2 = $_POST['mauvaiseRep2'];
        }
        if(isset($_POST['mauvaiseRep3'])){
            $mauvaiseRep3 = $_POST['mauvaiseRep3'];
        }

        
        return $this->render('validerQuestion.html.twig');
    }


}
