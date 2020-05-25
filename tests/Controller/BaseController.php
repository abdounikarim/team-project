<?php

namespace App\Tests\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseController extends WebTestCase
{
    private function getEntityManager(): EntityManagerInterface
    {
        self::bootKernel();

        return self::$container->get(EntityManagerInterface::class);
    }

    public function getCategory()
    {
        return $this->getEntityManager()->getRepository(Category::class);
    }

    public function login($user,$pass) {
        return static::createClient([], [
            'PHP_AUTH_USER' => $user,
            'PHP_AUTH_PW' => $pass,
        ]);
    }
}
