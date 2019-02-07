<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MonstreController extends AbstractController
{
    /**
     * @Route("/monstre", name="monstre")
     */
    public function index()
    {
        return $this->render('monstre/index.html.twig', [
            'controller_name' => 'MonstreController',
        ]);
    }
}
