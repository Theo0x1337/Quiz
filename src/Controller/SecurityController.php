<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        if (!filter_var($request->request->get('email')?? '', FILTER_VALIDATE_EMAIL)) {
            return $this->inscriptionErreur('Email invalide');
        } elseif ($request->request->get('password') != $request->request->get('password-repeat')) {
            return $this->inscriptionErreur('Les mots de passe ne correspondent pas');
        } elseif (strlen($request->request->get('password') ?? '') < 5) {
            return $this->inscriptionErreur('Le mot de passe est trop court (5 caractères)');
        } elseif ($request->request->get('name') == null) {
            return $this->inscriptionErreur('Le nom est requis');
        } elseif ($request->request->get('surname') == null) {
            return $this->inscriptionErreur('Le prénom est requis');
        } else {
            $user = new Utilisateur();
            $user->setEmail($request->request->get('email'));
            $user->setNom($request->request->get('name') ?? '');
            $user->setPrenom($request->request->get('surname') ?? '');

            $mdp = $passwordEncoder->encodePassword($user, $request->request->get('password'));
            $user->setMdp($mdp);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('accueil');
        }
    }

    private function inscriptionErreur(string $erreur)
    {
        return $this->render('security/inscription.html.twig', ['erreur' => $erreur]);
    }

    public function testForm(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($utilisateur, $utilisateur->getMdpClair());
            $utilisateur->setMdp($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('connexion');
        }

        return $this->render('security/test.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
