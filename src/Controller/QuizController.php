<?php
/**
 * Created by PhpStorm.
 * User: bernardintheo
 * Date: 29/04/2020
 * Time: 11:41
 */

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizController extends AbstractController
{
    public function quiz()
    {
        return $this->render('quiz.html.twig');
    }
}