<?php

namespace App\Controller\Admin;

use App\Form\AlbumType;
use App\Form\FormHandler\AlbumTypeHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/album", name="album")
 */
class AlbumController extends AbstractController
{

    private $formHandler;
    private $formFactory;

    public function __construct(AlbumTypeHandler $formHandler, AlbumType $formFactory)
    {
        $this->formHandler = $formHandler;
        $this->formFactory = $formFactory;
    }

    public function __invoke(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Login is require !');

        $form = $this->createForm(AlbumType::class);
        $form->handleRequest($request);

        if ($this->formHandler->handle($form)){

            $this->addFlash('success', 'Bravo ! Vous venez de créer un album avec succés :)');

            $this->redirectToRoute('dashboard');
        }

        return $this->render('Admin/mediaAlbum.html.twig', array('form' => $form->createView()));
    }
}
