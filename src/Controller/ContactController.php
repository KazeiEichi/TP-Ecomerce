<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        $message = new Message();
        $form = $this->createForm(ContactType::class, $message);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash("success","Votre message a bien été envoyé.");
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($message);
            $manager->flush();
        }
        return $this->render('contact/index.html.twig', [
            'contact' => $form->createView()
        ]);
    }
}
