<?php

namespace App\Controller;

use App\Model\BedroomManager;

class BedroomController extends AbstractController
{
    /**
     * Display bedroom page
     */

    public function bedroom(int $id): string
    {
        $bedroomManager = new BedroomManager();
        $bedroom = $bedroomManager->selectOneById($id);

        return $this->twig->render('Bedroom/bedroom.html.twig', ['bedroomTwig' => $bedroom]);
    }
}
