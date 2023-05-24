<?php

namespace App\Controller;

use App\Model\ChambreManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $chambreManager = new ChambreManager();
        $chambres = $chambreManager->selectAll();

        return $this->twig->render('Home/index.html.twig', ['chambresTwig' => $chambres]);
    }
}
