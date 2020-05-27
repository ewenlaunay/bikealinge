<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ActuController extends AbstractController
{
    /**
     * @Route("/actu", name="actu")
     */
    public function index()
    {
        return $this->render('actu/index.html.twig', [
            'controller_name' => 'ActuController',
        ]);
    }
}
