<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $hasher;

    // On demande à Symfony de nous donner le service de hachage
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('ewan.michel59@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);

        // On hache "123456" (ou ton vrai mot de passe)
        $password = $this->hasher->hashPassword($user, 'Inf0rm4t1Qu3#');
        dump($password); // Cela va afficher le hash dans ton terminal lors du chargement
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush(); // C'est ici que c'est envoyé en base !
    }
}