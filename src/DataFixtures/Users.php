<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class Users extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setPrenom('Admin');
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user-> setPlainPassword('123456789');
        $manager->persist($user);

        $user1 = new User();

        $user1->setPrenom('User');
        $user1->setEmail('user@example.com');
        $user1->setRoles(['ROLE_USER']);
        $user1-> setPlainPassword('123456');
        $manager->persist($user1);


        $manager->flush();
    }
}
