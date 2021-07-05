<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $blog = new Blog();
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($blog);
            $entityManager->flush();
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/show", name="show")
     */
    public function show(BlogRepository $blogRepository): Response
    {
        $blogs = $blogRepository->findAll();

        return $this->render('home/show.html.twig', [
            'blogs' => $blogs,
        ]);
    }
    /**
     * @Route("/edit", name="edit")
     */
    public function edit(BlogRepository $blogRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $blog = $blogRepository->findOneById(1);
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        }
        return $this->render('home/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
