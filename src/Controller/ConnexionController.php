<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class  SecurityController extends AbstractController
{
    public function inscription(Request $request)
    {

        if (!filter_var($request->query->get('email')?? '', FILTER_VALIDATE_EMAIL)) {
            return $this->inscriptionErreur('Email invalide');
        } elseif ($request->query->get('password') != $request->query->get('password-repeat')) {
            return $this->inscriptionErreur('Les mots de passe ne correspondent pas');
        } elseif (strlen($request->query->get('password') ?? '') < 5) {
            return $this->inscriptionErreur('Le mot de passe est trop court (5 caractères)');
        } elseif ($request->query->get('name') == null) {
            return $this->inscriptionErreur('Le nom est requis');
        } elseif ($request->query->get('surname') == null) {
            return $this->inscriptionErreur('Le prénom est requis');
        } else {
            $entityManager = $this->getDoctrine()->getManager();
            $user = new Utilisateur();
            $user->setEmail($request->query->get('email'));
            $user->setMdp($request->query->get('password'));
            $user->setNom($request->query->get('name') ?? '');
            $user->setPrenom($request->query->get('surname') ?? '');
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }
    }

    private function inscriptionErreur(string $erreur)
    {
        return $this->render('security/inscription.html.twig', ['erreur' => $erreur]);
    }

    private function isValid($user) : bool
    {
        return false;
    }
}
