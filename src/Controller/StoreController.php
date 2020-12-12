<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @Route("/", name="store")
     */
    public function index(): Response
    {
        return $this->render('store/index.html.twig', [
            'msg_accueil' => 'Accueil du site',
        ]);
    }
}

