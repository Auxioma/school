<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {

        $contact = new Contact();
        // cration du formulaire
        $form = $this->createForm(ContactFormType::class, $contact, [
            'method' => 'POST',
            'attr' => ['slug' => 'app_contact'] 
        ]);

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
        
            $email = (new TemplatedEmail())
                ->from($data->getMail()) // Assure-toi que getMail() existe
                ->to('gurvan@gmail.com')
                ->subject('Un nouveau message vient d\'arriver') // Correction d'orthographe
                ->htmlTemplate('emails/contactform.html.twig')
                ->context([
                    'data' => $data
                ]);
            $mailer->send($email);
        }
        
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
