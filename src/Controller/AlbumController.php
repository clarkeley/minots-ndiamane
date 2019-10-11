<?php


namespace App\Controller;


use App\Entity\Album;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{
    /**
     * @Route("/album", name="album")
     * @param Request $request
     * @param AlbumRepository $albumRepository
     * @return Response
     */
    public function index(Request $request, AlbumRepository $albumRepository)
    {
        $page = $request->query->get('page',1);
        $maxPage = $albumRepository->getMaxPage();
        dump($maxPage);
        $album = $albumRepository->getAll($page);

        return $this->render('album/album.html.twig', ['album' => $album, 'page' => $page, 'maxPage' => $maxPage]);
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