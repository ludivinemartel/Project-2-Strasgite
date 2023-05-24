<?php

namespace App\Controller;

class LegalnoticeController extends AbstractController
{
    /**
     * Display bedroom page
     */
    public function legalnotice(): string
    {
        return $this->twig->render('LegalNotice/legalnotice.html.twig');
    }
}
