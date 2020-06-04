<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    public function index()
    {
        return $this->render('admin/base.html.twig', [
            'controller_name' => 'AdminController::index',
        ]);
    }

    public function utilisateurs()
    {
        return $this->render('admin/base.html.twig', [
            'controller_name' => 'AdminController::utilisateurs',
        ]);
    }

    public function editerUtilisateur()
    {
        return $this->render('admin/base.html.twig', [
            'controller_name' => 'AdminController::editerUtilisateur',
        ]);
    }

    public function quiz()
    {
        return $this->render('admin/base.html.twig', [
            'controller_name' => 'AdminController::quiz',
        ]);
    }

    public function editerQuiz()
    {
        return $this->render('admin/base.html.twig', [
            'controller_name' => 'AdminController::editerQuiz',
        ]);
    }

    public function propositionsQuiz()
    {
        return $this->render('admin/base.html.twig', [
            'controller_name' => 'AdminController::propositionsQuiz',
        ]);
    }
}
