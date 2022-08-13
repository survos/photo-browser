<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */

class TestController extends AbstractController
{
    /**
     * @Route("/tables", name="test_tables")
     */
    public function tables()
    {
        return $this->render('test/tables.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
