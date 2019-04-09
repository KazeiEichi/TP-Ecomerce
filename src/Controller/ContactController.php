<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
        $message = new Message();
        $form = $this->createForm(ContactType::class, $message);
        return $this->render('contact/index.html.twig', [
            'form' => $form
        ]);
    }
}
