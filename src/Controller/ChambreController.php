<?php

namespace App\Controller;

use App\Model\ChambreManager;

class ChambreController extends AbstractController
{
    /**
     * Show informations for a specific item
     */
    public function chambre(): string
    {
        $chambreManager = new ChambreManager();
        $chambres = $chambreManager->selectAll();

        return $this->twig->render('chambre/chambre.html.twig', ['chambresTwig' => $chambres]);
    }
}
