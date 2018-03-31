<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/test")
 */

class TestController extends Controller
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
