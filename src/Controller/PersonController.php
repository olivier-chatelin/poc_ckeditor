<?php

namespace App\Controller;

use App\Entity\Person;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $persons = $managerRegistry->getRepository(Person::class)->findAll();

        return $this->render('person/index.html.twig', [
            'persons' => $persons,
        ]);
    }
}
