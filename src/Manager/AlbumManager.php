<?php


namespace App\Manager;


use App\Entity\Album;
use App\Entity\Picture;

class AlbumManager
{
    public function addPicture(Album  $album): void
    {
        $album->addPicture(new Picture());
    }

}