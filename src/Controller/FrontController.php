<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\AddCategoryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function followPage(EntityManagerInterface $em, Request $request)
    {
        
        $formCategory = $this->createForm(AddCategoryFormType::class);
        $formCategory->handleRequest($request);

        if($formCategory->isSubmitted() && $formCategory->isValid()) {
            //$category = $formCategory->getData();
            $category = new Category();
            $category->setUser($this->getUser());
            $category->setName($formCategory->get('name')->getData());
            
            $em->persist($category);
            $em->flush();
            $this->redirectToRoute('follow');
        }
        
        return $this->render('front/follow.html.twig',[
            'formCategory' => $formCategory->createView(),
        ]);
    }

    /**
     * @Route("/feed", name="link_page")
     */
    public function displayLinkPage()
    {
        return $this->render('front/feed.html.twig',[

        ]);
    }
}
