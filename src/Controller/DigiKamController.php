<?php

namespace App\Controller;

use App\Entity\AlbumRoots;
use App\Entity\Albums;
use App\Entity\Image;

use App\Entity\Tags;
use App\Repository\AlbumsRepository;
use App\Repository\ImageRepository;
use App\Service\ImageService;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs;

class DigiKamController extends Controller
{

    private function getConnection(): Connection
    {
        /** @var Connection $connection */
        return $this->getDoctrine()->getConnection('thumb');
    }

    /*
     * Database Connectoptions=
Database Hostname=us-cdbr-iron-east-03.cleardb.net
Database Name=heroku_56b2a085e85da39
Database Name Face=heroku_56b2a085e85da39
Database Name Similarity=heroku_56b2a085e85da39
Database Name Thumbnails=heroku_56b2a085e85da39
Database Password=43d58a95
Database Port=3306
Database Type=QMYSQL
Database Username=b6d568a5b2dda2


    Database Connectoptions=
Database Hostname=us-cdbr-iron-east-03.cleardb.net
Database Name=heroku_56b2a085e85da39
Database Name Face=heroku_56b2a085e85da39
Database Name Similarity=heroku_56b2a085e85da39
Database Name Thumbnails=heroku_56b2a085e85da39
Database Password=43d58a95
Database Port=3306
Database Type=QMYSQL
Database Username=b6d568a5b2dda2
Internal Database Server=false
Internal Database Server Mysql Init Command=
Internal Database Server Mysql Server Command=
Internal Database Server Path=

    [Database Settings]
Database Connectoptions=
Database Hostname=mcldisu5ppkm29wf.cbetxkdyhwsb.us-east-1.rds.amazonaws.com
Database Name=mancmvactb8s2peq
Database Name Face=mancmvactb8s2peq
Database Name Similarity=mancmvactb8s2peq
Database Name Thumbnails=mancmvactb8s2peq
Database Password=bd6foiqgtbmjjh7r
Database Port=3306
Database Type=QMYSQL
Database Username=qfnyc3y4nemxdw0e
Internal Database Server=false
Internal Database Server Mysql Init Command=
Internal Database Server Mysql Server Command=
Internal Database Server Path=

# qfnyc3y4nemxdw0e:bd6foiqgtbmjjh7r@mcldisu5ppkm29wf.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/mancmvactb8s2peq


    Database Connectoptions=
Database Hostname=127.0.0.1
Database Name=digikam
Database Name Face=digikam
Database Name Similarity=digikam
Database Name Thumbnails=digikam
Database Password=dk
Database Port=3306
Database Type=QMYSQL
Database Username=digikam
Internal Database Server=false
Internal Database Server Mysql Init Command=
Internal Database Server Mysql Server Command=
Internal Database Server Path=

    mysql://b6d568a5b2dda2:43d58a95@us-cdbr-iron-east-03.cleardb.net/heroku_56b2a085e85da39?reconnect=true

     */

    /**
     * @Route("/thumb/{id}", name="dk_thumb")
     */
    public function thumb(Connection $connection, $id)
    {
        $connection = $this->getConnection();
        $r = $connection->executeQuery("select * from Thumbnails where id = $id")->fetch();
        dump($r); die();

        if ($r) {
            $response = new Response();
            // $response->headers->set('Content-type', mime_content_type($path));
            // $response->headers->set('Content-length', filesize($path));
            $response->sendHeaders();
            $response->setContent($r['data']);
            return $response;
        } else {
            throw new NotFoundHttpException("No path for $path");
        }



        return $this->render("dk/albumRoots.html.twig", [
            'albumRoots' =>
            $this->getDoctrine()->getRepository(AlbumRoots::class)->findAll()
        ]);

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
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboardAction()
    {
        $em = $this->getDoctrine()->getManager();
        return $this->render('easy_admin/dashboard.html.twig', [
            'tags' => $this->getDoctrine()->getRepository(Tags::class)->findAll()
        ]);
    }


    /**
     * @Route("/", name="home")
     */
    public function home(AlbumsRepository $albumsRepository, ImageRepository $imageRepository)
    {
        $breadcrumbs = $this->setBreadcrumbs();
        $breadcrumbs->addItem("Dashboard", '/');

        // Example with parameter injected into translation "user.profile"
        // $breadcrumbs->addItem($txt, $url, ["%user%" => $user->getName()]);

        return $this->render("dashboard.html.twig", [
            'tags' => $this->getDoctrine()->getRepository(Tags::class)->findAll(),
            'albumCount' => $albumsRepository->count([]),
            'imageCount' => $imageRepository->count([]),
            'albumRoots' =>
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
    public function showAlbum(Request $request, $albumId, ImageRepository $imageRepository)
    {
        $album = $this->getDoctrine()->getRepository(Albums::class)->find($albumId);
        $albumRoot = $album->getAlbumroot();
        $breadcrumbs = $this->setBreadcrumbs()
            ->addRouteItem($albumRoot, 'dk_album_root', $albumRoot->getRp())
            ->addRouteItem($album, 'dk_album', $album->getRp());


        $imagesQuery = $imageRepository->createQueryBuilder('i')
            ->join('i.meta', 'meta')
            ->andWhere('i.album = :album')
            ->setParameter('album', $album);



        return $this->render("dk/album.html.twig", [
            'album' => $album,
            'images' => $imagesQuery->getQuery()->getResult()
            ]);
    }

    /**
     * @Route("/image/{id}", name="dk_image")
     */
    public function showImage(Image $image, ImageService $service)
    {
        $history  = $service->getHistory($image);
        $album = $image->getAlbum();
        $albumRoot = $album->getAlbumroot();
        $this->setBreadcrumbs()
            ->addRouteItem($albumRoot, 'dk_album_root', $albumRoot->getRp())
            ->addRouteItem($album, 'dk_album', $album->getRp())
            ->addItem($image);

        return $this->render("dk/image.html.twig", [
            'image' => $image,
            'history' => $history
        ]);
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
