<?php


namespace App\Controller;


use App\Entity\NewsLetter;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function subscriber(Request $request)
    {
        $subscriber = new NewsLetter();

        $form = $this->createForm(NewsType::class, $subscriber);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $subscriber = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscriber);
            $entityManager->flush();

            $this->addFlash('success', 'Inscription validée ! :)');

            return $this->redirectToRoute('home');
        }

        return $this->render('home.html.twig', ['form' => $form->createView()]);
    }
}