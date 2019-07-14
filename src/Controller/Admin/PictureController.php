<?php


namespace App\Controller\Admin;


use App\Form\FormHandler\PicTypeHandler;
use App\Form\PicType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/addpicture", name="app_media_picture")
 */
class PictureController extends AbstractController
{
    private $formHandler;
    private $formFactory;

    public function __construct(PicTypeHandler $formHandler, PicType $formFactory)
    {
        $this->formHandler = $formHandler;
        $this->formFactory = $formFactory;
    }

    public function __invoke(Request $request): Response
    {
        $form = $this->createForm(PicType::class);
        $form->handleRequest($request);

        if ($this->formHandler->handle($form)) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash('sucess', 'succes');

            $this->redirectToRoute('app_media_picture');
        }

        return $this->render('Admin/mediaPicture.html.twig', array('form' => $form->createView()));
    }

}