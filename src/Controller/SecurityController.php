<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class SecurityController extends AbstractController
{
    public function inscriptionOld(Request $request, UserPasswordEncoderInterface $passwordEncoder)
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

    public function inscription(LoginFormAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($utilisateur, $utilisateur->getMdpClair());
            $utilisateur->setMdp($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            // TODO envoie d'un email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $utilisateur,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
