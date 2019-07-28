<?php


namespace App\Controller\Admin;

use App\Form\FormHandler\PicTypeHandler;
use App\Form\PicType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function __invoke(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Login is require !');

        $form = $this->createForm(PicType::class);
        $form->handleRequest($request);

        if ($this->formHandler->handle($form)) {

            $this->addFlash('success', 'Photo enregistrée ! :)');

            $this->redirectToRoute('dashboard');
        }

        return $this->render('Admin/mediaPicture.html.twig', array('form' => $form->createView()));
    }
}