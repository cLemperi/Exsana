<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->encoder = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User;
        $user->setUsername('demoUser');
        $user->setPassword($this->encoder->hashPassword($user,'demoUser'));
        $user->getRoles();


        //Add admin
        $admin = new User;
        $admin->setUsername('demoAdmin');
        $admin->setPassword($this->encoder->hashPassword($admin,'demoAdmin'));
        $admin->setRoles(array('ROLE_ADMIN'));

        $manager->persist($user);
        $manager->persist($admin);

        $manager->flush();
    }
}
