<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends AbstractController
{
    /**
     * @Route("/mail/{id}", name="mail")
     */
    public function index(Person $person, Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(EmailType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $emailData = $request->request->get('email');
            $email = (new Email())
                ->from($emailData['from'])
                ->to($person->getMail())
                ->subject(($emailData['object']))
                ->html($emailData['body']);
            $mailer->send($email);

        }
        return $this->renderForm('mail/index.html.twig', [
            'form' => $form,
        ]);
    }
}
