<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }

    /**
     * @Route("/follow", name="follow")
     */
    public function followPage()
    {
        return $this->render('front/follow.html.twig');
    }

    /**
     * @Route("/feed", name="link_page")
     */
    public function displayLinkPage()
    {
        return $this->render('front/feed.html.twig');
    }
}
