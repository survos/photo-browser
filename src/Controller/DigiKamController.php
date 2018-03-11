<?php

namespace App\Controller;

use App\Entity\AlbumRoots;
use App\Entity\Albums;
use App\Entity\Image;
use Doctrine\DBAL\Connection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;

class DigiKamController extends Controller
{

    private function getConnection(): Connection
    {
        /** @var Connection $connection */
        return $this->getDoctrine()->getConnection('default');
    }

    /**
     * @Route("/roots", name="digi_kam")
     */
    public function index(Connection $connection)
    {
        return $this->render("dk/albumRoots.html.twig", ['albumRoots' =>
            $this->getDoctrine()->getRepository(AlbumRoots::class)->findAll()
        ]);

    }

    private function setBreadcrumbs(): Breadcrumbs {
        $breadcrumbs = $this->get("white_october_breadcrumbs");

        // Simple example
        $breadcrumbs->addItem("Home", $this->get("router")->generate("home"));

        return $breadcrumbs;

    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $breadcrumbs = $this->setBreadcrumbs();
        $breadcrumbs->addItem("Dashboard", '/');

        // Example with parameter injected into translation "user.profile"
        // $breadcrumbs->addItem($txt, $url, ["%user%" => $user->getName()]);

        return $this->render("dashboard.html.twig", ['albumRoots' =>
            $this->getDoctrine()->getRepository(AlbumRoots::class)->findAll()
        ]);

    }

    /**
     * @Route("/root/{albumRootId}", name="dk_album_root")
     */
    public function albumRoot(Request $request, $albumRootId)
    {
        $albumRoot = $this->getDoctrine()->getRepository(AlbumRoots::class)->find($albumRootId);



        $this->setBreadcrumbs()
            ->addRouteItem($albumRoot->__toString(), 'dk_album_root', $albumRoot->getRP() );

        return $this->render("dk/albums.html.twig", [
            'albumRoot' => $albumRoot,
            'albums' => $albumRoot->getAlbums(),
        ]);

    }

    /**
     * @Route("/album/{albumId}", name="dk_album")
     */
    public function showAlbum(Request $request, $albumId)
    {
        $album = $this->getDoctrine()->getRepository(Albums::class)->find($albumId);
        $albumRoot = $album->getAlbumroot();
        $breadcrumbs = $this->setBreadcrumbs()
            ->addRouteItem($albumRoot, 'dk_album_root', $albumRoot->getRp())
            ->addRouteItem($album, 'dk_album', $album->getRp());


        return $this->render("dk/album.html.twig", ['album' => $album ]);
    }

    /**
     * @Route("/image/{id}", name="dk_image")
     */
    public function showImage(Image $image)
    {
        $album = $image->getAlbum();
        $albumRoot = $album->getAlbumroot();
        $this->setBreadcrumbs()
            ->addRouteItem($albumRoot, 'dk_album_root', $albumRoot->getRp())
            ->addRouteItem($album, 'dk_album', $album->getRp())
            ->addItem($image);

        return $this->render("dk/image.html.twig", ['image' => $image]);
    }

    /**
     * @Route("/jpg/{id}.jpg", name="dk_jpg")
     */
    public function showJpeg(Image $image)
    {
        $root = $this->getParameter('image_root');

        $path = $image->getFilePath();
        if (file_exists($path)) {
            $response = new Response();
            $response->headers->set('Content-type', mime_content_type($path));
            $response->headers->set('Content-length', filesize($path));
            $response->sendHeaders();
            $response->setContent(readfile($path));
            return $response;
        } else {
            throw new NotFoundHttpException("No path for $path");
        }

    }

}
