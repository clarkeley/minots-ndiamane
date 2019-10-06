<?php


namespace App\Controller;


use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{
    /**
     * @Route("/album", name="album")
     */
    public function index()
    {
        $album = $this->getDoctrine()->getRepository(Album::class)->findAll();

        return $this->render('album/album.html.twig', ['album' => $album]);
    }

    /**
     * @Route("/album/{id}", name="album_show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $album = $this->getDoctrine()->getRepository(Album::class)->find($id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$id
            );
        }

        return $this->render('album/albumShow.html.twig', ['album' => $album]);

    }

}