<?php

namespace App\Controller;

use App\Entity\Tutorial;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Response;

class TutorialController extends Controller
{
    /**
     * @Route("/tutorial", name="tutorial")
     */
    public function index()
    {

        $tutorialRoot = getenv('TUTORIAL_DIR');
        $tutorials = [];

        $finder = new Finder();
        /** @var SplFileInfo $file */
        foreach ($finder->in($tutorialRoot) as $file) {
            if ($file->isDir()) {
                $tutorial = new Tutorial();
                $tutorial->setName($file->getBasename());
                array_push($tutorials, $tutorial);
                dump($tutorial);
            }
        }
        // replace this line with your own code!
        // return $this->render('@Maker/demoPage.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__) ]);
        return $this->render('list.html.twig', [
            'tutorials' => $tutorials,
            'root' => getenv('TUTORIAL_DIR'),
            'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__)
        ]);
    }
}
