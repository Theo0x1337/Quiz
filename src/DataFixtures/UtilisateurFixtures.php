<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $user = new Utilisateur();
        $user->setPrenom('Super');
        $user->setNom('User');
        $user->setEmail('admin@localhost');
        $user->setMdp($this->passwordEncoder->encodePassword(
             $user,
             'admin'
         ));

        $manager->persist($user);
        $manager->flush();
    }
}
