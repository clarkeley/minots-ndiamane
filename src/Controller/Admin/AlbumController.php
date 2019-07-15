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
        $form = $this->createForm(AlbumType::class);
        $form->handleRequest($request);

        if ($this->formHandler->handle($form)){

            $this->addFlash('sucess', 'succes');

            $this->redirectToRoute('album');
        }

        return $this->render('Admin/mediaAlbum.html.twig', array('form' => $form->createView()));
    }
}