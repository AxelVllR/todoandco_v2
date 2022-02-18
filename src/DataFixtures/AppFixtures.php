<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;


class AppFixtures extends Fixture
{

    public function __construct() {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $user = (new User)
            ->setUsername("test")
            ->setEmail("test@gmail.com");

        $user->setPassword('$argon2id$v=19$m=65536,t=4,p=1$TGUqD259UYu57mRgq82xeQ$f+0B+7KdGSn8pZNx0XpjaDPPt54rhy9tQEeQnRS5iqc');
        $userAdmin = (new User)
            ->setUsername("testAdmin")
            ->setRoles(['ROLE_ADMIN'])
            ->setEmail("testadmin@gmail.com");

        $userAdmin->setPassword('$argon2id$v=19$m=65536,t=4,p=1$TGUqD259UYu57mRgq82xeQ$f+0B+7KdGSn8pZNx0XpjaDPPt54rhy9tQEeQnRS5iqc');
        $manager->persist($user);
        $manager->persist($userAdmin);
        $users = [
            0 => $userAdmin,
            1 => $user,
            2 => null
        ];
        $i = 0;
        while($i < 20) {
            $i++;
            $task = new Task;
            $task->setTitle($faker->title);
            $task->setContent($faker->text);
            $task->setUser($users[rand(0, 2)]);
            $task->toggle(false);
            $manager->persist($task);
        }

        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }
}
