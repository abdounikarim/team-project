<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('Paul0505@gmail.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'000000'));
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('Xavier76@gmail.com');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,'000000'));
        $manager->persist($user2);

        $manager->flush();
    }
}
