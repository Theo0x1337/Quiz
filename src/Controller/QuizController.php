<?php
/**
 * Created by PhpStorm.
 * User: bernardintheo
 * Date: 29/04/2020
 * Time: 11:41
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Entity\Reponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class QuizController extends AbstractController
{
    public function quiz()
    {
        return $this->render('quiz/quiz.html.twig', [
            'quizzes' => $this->getDoctrine()->getRepository(Quizz::class)->findAll()
        ]);
    }

    public function play($id)
    {
        $questionsObj = $this->getDoctrine()->getRepository(Quizz::class)->find($id)->getQuestions();
        $questions = [];
        $reponses = [];

        foreach ($questionsObj as $question) {
            foreach ($question->getReponses() as $reponse) {
                $reponses[] = [
                    'id' => $reponse->getId(),
                    'text' => $reponse->getText(),
                    'vrai' => $reponse->getIsTrue()
                ];
            }

            $questions[] = [
                'id' => $question->getId(),
                'text' => $question->getText(),
                'reponses' => $reponses
            ];
        }

        return $this->render('quiz/play.html.twig', [
            'questions' => $questions,
            'reponses' => $reponses
        ]);
    }

    public function ajouterQuestion($id)
    {
        return $this->render('quiz/ajouterQuestion.html.twig', [
            'id' => $id,
            'isQuestionAdded' => False
        ]);
    }

    public function validerQuestion(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();


        $idQuiz = $request->request->get('idQuiz');
        $question = $request->request->get('question');
        $bonneRep = $request->request->get('bonneRep');
        $mauvaiseRep1 = $request->request->get('mauvaiseRep1');
        $mauvaiseRep2 = $request->request->get('mauvaiseRep2');
        $mauvaiseRep3 = $request->request->get('mauvaiseRep3');


        $objectQuestion = new Question();
        $objectQuestion->setText($question);
        $objectQuizz = $this->getDoctrine()->getRepository(Quizz::class)->find($idQuiz);
        $objectQuestion->setQuizz($objectQuizz);
        $entityManager->persist($objectQuestion);

        $objectBonneReponse = new Reponse();
        $objectBonneReponse->setText($bonneRep);
        $objectBonneReponse->setQuestion($objectQuestion);
        $objectBonneReponse->setIsTrue(True);
        $entityManager->persist($objectBonneReponse);

        $objectMauvaiseReponse1 = new Reponse();
        $objectMauvaiseReponse1->setText($mauvaiseRep1);
        $objectMauvaiseReponse1->setQuestion($objectQuestion);
        $objectMauvaiseReponse1->setIsTrue(False);
        $entityManager->persist($objectMauvaiseReponse1);

        if (isset($mauvaiseRep2) && $mauvaiseRep2!=null){
            $objectMauvaiseReponse2 = new Reponse();
            $objectMauvaiseReponse2->setText($mauvaiseRep2);
            $objectMauvaiseReponse2->setQuestion($objectQuestion);
            $objectMauvaiseReponse2->setIsTrue(False);
            $entityManager->persist($objectMauvaiseReponse2);
        }

        if (isset($mauvaiseRep3) && $mauvaiseRep3!=null){
            $objectMauvaiseReponse3 = new Reponse();
            $objectMauvaiseReponse3->setText($mauvaiseRep3);
            $objectMauvaiseReponse3->setQuestion($objectQuestion);
            $objectMauvaiseReponse3->setIsTrue(False);
            $entityManager->persist($objectMauvaiseReponse3);
        }

        $entityManager->flush();

        return $this->render('quiz/ajouterQuestion.html.twig', [
            'id' => $idQuiz,
            'isQuestionAdded' => True
        ]);
    }


}
