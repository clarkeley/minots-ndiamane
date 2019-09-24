<?php


namespace App\Controller;


use App\Form\ContactType;
use App\Form\FormHandler\ContactTypeHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact", name="contact")
 */
class ContactController extends AbstractController
{
    private $formHandler;
    private $formFactory;

    public function __construct(ContactTypeHandler $handler, FormFactoryInterface $formFactory)
    {
        $this->formHandler = $handler;
        $this->formFactory = $formFactory;
    }

    public function __invoke(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($this->formHandler->handle($form)) {
            $this->addFlash('success', 'Message envoyé !');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact.html.twig', array('form' => $form->createView()));
    }
}