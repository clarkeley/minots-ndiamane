<?php


namespace App\Controller;

use App\Form\FormHandler\NewsTypeHandler;
use App\Form\NewsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/home", name="home")
 */
class HomeController extends AbstractController
{
    private $formHandler;
    private $formFactory;
    public function __construct(NewsTypeHandler $formHandler, NewsType $formFactory)
    {
        $this->formHandler = $formHandler;
        $this->formFactory = $formFactory;
    }
    public function __invoke(Request $request)
    {
        $form = $this->createForm(NewsType::class);
        $form->handleRequest($request);
        if ($this->formHandler->handle($form))
        {
            $this->addFlash('success', 'Inscription validée ! :)');
            return $this->redirectToRoute('home');
        }
        return $this->render('home.html.twig', ['form' => $form->createView()]);
    }
}