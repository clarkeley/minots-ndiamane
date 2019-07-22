<?php


namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Picture;
use App\Form\FormHandler\PicTypeHandler;
use App\Form\PicType;
use App\Manager\AlbumManager;
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
    private $albumManager;

    public function __construct(PicTypeHandler $formHandler, PicType $formFactory, AlbumManager $albumManager)
    {
        $this->formHandler = $formHandler;
        $this->formFactory = $formFactory;
        $this->albumManager = $albumManager;
    }

    public function __invoke(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'Login is require !');

        $form = $this->createForm(PicType::class);
        $form->handleRequest($request);

        //$this->albumManager->addPicture($album);

        if ($this->formHandler->handle($form)) {

            $this->addFlash('sucess', 'succes');

            $this->redirectToRoute('app_media_picture');
        }

        return $this->render('Admin/mediaPicture.html.twig', array('form' => $form->createView()));
    }
}